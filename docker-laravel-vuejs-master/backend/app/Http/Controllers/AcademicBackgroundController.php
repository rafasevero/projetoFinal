<?php

namespace App\Http\Controllers;

use App\Models\Academic_background;
use Illuminate\Http\Request;

class AcademicBackgroundController extends Controller
{
    public function storeAcademic(Request $request){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $validated = $request->validate([
            'institution' => 'required|string',
            'course' => 'required|string',
            'education_level' => 'required|string|in:fundamental incompleto,fundamental completo',
            'start_date' => 'required|date',
            'completion_date' => 'required|date'
        ]);

        $validated['user_id'] = $user->id;

        Academic_background::create($validated);

        return response()->json(['message' => 'Experiência Acadêmica adicionada com sucesso!'], 201);
    }
}
