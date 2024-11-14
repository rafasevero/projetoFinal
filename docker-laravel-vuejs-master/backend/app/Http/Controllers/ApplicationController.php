<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function applyForJob(Request $request , $vacancy_id){
        $user = auth()->guard('user')->user();

        if($user->applications()->where('vacancy_id', $vacancy_id)->exists()){
            return response()->json(['message' => 'Você já aplicou para essa vaga'], 401);
        }

        $application = Application::create([
            'user_id' => $user->id,
            'vacancy_id' => $vacancy_id,
        ]);

        if ($application) {
            return response()->json(['message' => 'Candidatura realizada com sucesso!'], 201);
        } else {
            return response()->json(['message' => 'Falha ao se candidatar. Tente novamente.'], 500);
        }
    }
}
