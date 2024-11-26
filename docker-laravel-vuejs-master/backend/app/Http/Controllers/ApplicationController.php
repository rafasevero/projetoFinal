<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function applyForJob(Request $request, $vacancy_id)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'Usuário não autenticado.'], 401);
    }

    $validated = $request->validate([
        'application_date' => 'required|date',
        'status' => 'required|string|max:100',
        'application_name' => 'required|string|max:100',
    ]);

    // Verificar se a vaga existe
    $vacancy = Vacancies::find($vacancy_id);

    if (!$vacancy) {
        return response()->json(['message' => 'Vaga não encontrada.'], 404);
    }

    // Verificar se o usuário já está inscrito nesta vaga
    $existingVacancy = Application::where('vacancy_id', $vacancy_id)
        ->where('user_id', $user->id)
        ->first();

    if ($existingVacancy) {
        return response()->json([
            'message' => 'Você já está inscrito nesta vaga!'
        ], 400);
    }

    // Criar a candidatura
    $application = Application::create([
        'vacancy_id' => $vacancy->id,
        'user_id' => $user->id,
        'recruiter_id' => $vacancy->recruiter_id, // Agora acessamos corretamente
        'application_date' => now(),
        'status' => $validated['status'],
        'application_name' => $validated['application_name']
    ]);

    // Inserir na tabela intermediária user_application
    DB::table('user_application')->insert([
        'user_id' => $user->id,
        'application_id' => $application->id,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json([
        'message' => 'Candidatura realizada com sucesso!',

        'application' => $application
    ]);
}

public function getUsersForVacancies($vacancy_id)
{
    $recruiter = Auth::user();

    // Verificar se o recrutador está autenticado
    if (!$recruiter) {
        return response()->json(['message' => 'Usuário não autenticado. Faça login como recrutador.'], 401);
    }

    // Verificar se a vaga pertence ao recrutador
    $vacancy = Vacancies::where('id', $vacancy_id)
        ->where('recruiter_id', $recruiter->id)
        ->first();

    if (!$vacancy) {
        return response()->json([
            'message' => 'Vaga não encontrada ou você não tem permissão para visualizá-la.',
        ], 404);
    }

    // Obter todas as candidaturas para a vaga
    $userApplications = Application::where('vacancy_id', $vacancy_id)
        ->with('users:id,full_name,email')  // Carregar os usuários (candidatos) associados à candidatura
        ->get();

    // Verificar se há candidaturas
    if ($userApplications->isEmpty()) {
        return response()->json([
            'message' => 'Não há candidaturas cadastradas para esta vaga.',
        ], 404);
    }

    // Acessar diretamente os usuários de cada candidatura
    $users = $userApplications->flatMap(function ($application) {
        return $application->users; // Retorna todos os usuários associados à candidatura
    });

    // Retornar os usuários encontrados
    return response()->json([
        'message' => 'Candidatos encontrados com sucesso!',
        'candidates' => $users,
    ], 200);
}


}

