<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function storeCurriculum(Request $request){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf|max:10240'
        ]);

        $validated['user_id'] = $user->id;

        Curriculum::create($validated);

        return response()->json(['message' => 'Currículo anexado com sucesso!'], 201);
    }
}
