<?php

namespace App\Http\Controllers;

use App\Models\Applications;
use App\Models\Vacancies;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function applyForJob(Request $request, $vacancy_id){

        $validated = $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'user_id' => 'required|exists:users,id',
            'application' => 'required|string|max:1000',
            'status' => 'required|string|max:100',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $existingVacancy = Applications::where('vacancy_id', $validated['vacancy_id'])
            ->where('user_id',$user->id)
            ->first();

        if($existingVacancy){
            return response()->json([
                'message' => 'Você já está inscrito nesta vaga!'
            ],400);
        }

        $applications = Application::create([
            'vacancy_id' => $validated['vacancy_id'],
            'user_id' => $user->id,
            'application_date' => now(),
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Candidatura realizada com sucesso!',
            'application' => $applications
        ]);





    }
}
