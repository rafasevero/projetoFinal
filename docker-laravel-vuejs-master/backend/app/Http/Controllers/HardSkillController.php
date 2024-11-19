<?php

namespace App\Http\Controllers;

use App\Models\Hardskill;
use Illuminate\Http\Request;

class HardSkillController extends Controller
{
    public function storeHardSkill(Request $request){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $validated = $request->validate([
            'descricao' => 'required|string'
        ]);

        $validated['user_id'] = $user->id;

        Hardskill::create($validated);

        return response()->json(['message' => 'Hardskills adicionadas com sucesso!'], 201);
    }
}
