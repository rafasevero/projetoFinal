<?php

namespace App\Http\Controllers;

use App\Models\Vacancies;
use Illuminate\Console\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function applyForJob(Request $request, $vacancy_id)
    {
        $user = auth()->guard('user')->user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        // vê se a vaga existe
        $vacancy = Vacancies::find($vacancy_id);
        if (!$vacancy) {
            return response()->json(['message' => 'Vaga não encontrada.'], 404);
        }

        // vê se o usuário já aplicou para a vaga
        if ($user->applications()->where('vacancy_id', $vacancy_id)->exists()) {
            return response()->json(['message' => 'Você já aplicou para essa vaga.'], 409);
        }

        // valida informações adicionais
        $validated = $request->validate([
            'application_date' => 'required|date',
            'status' => 'required|string|in:ativa,inativa'
        ]);

        // cria a candidatura
        $application = Application::create([
            'user_id' => $user->id,
            'vacancy_id' => $vacancy_id,
            'application_date' => $validated['application_date'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Candidatura realizada com sucesso!',
            'application' => $application,
            'user' => $user,
            'vacancy' => $vacancy
        ], 201);
    }
}
