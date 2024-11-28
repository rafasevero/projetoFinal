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

        ]);

        $validated['application_date'] = now();

        $vacancy = Vacancies::find($vacancy_id);

        if (!$vacancy) {
            return response()->json(['message' => 'Vaga não encontrada.'], 404);
        }

        $birthdate = $user->date_of_birth;

        if (!$birthdate) {
            return response()->json(['message' => 'Data de nascimento não encontrada para o usuário.'], 400);
        }

        $age = \Carbon\Carbon::parse($birthdate)->age;

        $minAge = $vacancy->min_age;

        if ($age < $minAge) {
            return response()->json([
                'message' => 'Você não atende à idade mínima exigida para esta vaga.'
            ], 400);
        }

        $existingVacancy = Application::where('vacancy_id', $vacancy_id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingVacancy) {
            return response()->json([
                'message' => 'Você já está inscrito nesta vaga!'
            ], 400);
        }

        $application = Application::create([//cria a candidatura
            'vacancy_id' => $vacancy->id,
            'user_id' => $user->id,
            'recruiter_id' => $vacancy->recruiter_id,
            'application_date' => now(),
        ]);


        DB::table('user_application')->insert([ // insere na tabela intermediária user_application
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

        if (!$recruiter) {
            return response()->json(['message' => 'Usuário não autenticado como recrutador.'], 401);
        }

        $vacancy = Vacancies::where('id', $vacancy_id)  // verifica se a vaga pertence ao recrutador
            ->where('recruiter_id', $recruiter->id)
            ->first();

        if (!$vacancy) {
            return response()->json([
                'message' => 'Vaga não encontrada ou você não tem permissão para visualizá-la.',
            ], 404);
        }

        $userApplications = Application::where('vacancy_id', $vacancy_id)
        ->with('users.softSkills', 'users.hardSkills', 'users.curriculum', 'users.experience', 'users.academic_background')
        ->get();

        if ($userApplications->isEmpty()) {
            return response()->json([
                'message' => 'Não há candidaturas cadastradas para esta vaga.',
            ], 404);
        }

        $users = $userApplications->flatMap(function ($application) { // O flatMap permite a modificação ou mudança da estrutura dos itens dentro de uma coleção
            return $application->users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'softSkills' => optional($user->softSkills)->pluck('descricao')->toArray(),
                    'hardSkills' => optional($user->hardSkills)->pluck('descricao')->toArray(),
                    'curriculum' => optional($user->curriculum)->pluck('file')->toArray(),
                    'experience' => optional($user->experience)->pluck('company_name', 'position')->toArray(),
                    'academic_background' => optional($user->academic_background)->pluck('education_level')->toArray(),
                ];
            });
        });// pluck é usado para extrair um array dos valores de um campo específico das tabelas relacionadas

        return response()->json([
            'message' => 'Candidatos encontrados com sucesso!',
            'candidates' => $users,
        ], 200);
    }


}

