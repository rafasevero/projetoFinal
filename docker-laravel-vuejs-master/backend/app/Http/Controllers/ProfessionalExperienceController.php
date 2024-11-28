<?php

namespace App\Http\Controllers;

use App\Models\Professional_experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessionalExperienceController extends Controller
{
    public function storeExperience(Request $request){

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $validated['user_id'] = $user->id;

        Professional_experiences::create($validated);

        return response()->json(['message' => 'Experiência Profissional adicionada com sucesso!'], 201);
    }

    public function updateExperience(Request $request, $id){

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $professionalExperience = Professional_experiences::where('id', $id)->where('user_id', $user->id)->first();

        if (!$professionalExperience) {
            return response()->json([
                'message' => 'Formação acadêmica não encontrada ou você não tem permissão para editá-la.',
            ], 404);
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Experiência Profissional atualizada com sucesso!',
            'professional_experience' => $validated,
            'user'=> $user
        ]);
    }

    

}
