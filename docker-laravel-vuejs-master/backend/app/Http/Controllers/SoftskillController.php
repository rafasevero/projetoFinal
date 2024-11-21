<?php

namespace App\Http\Controllers;

use App\Models\Softskill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoftskillController extends Controller
{
    public function storeSoftSkill(Request $request){

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $validated = $request->validate([
            'descricao' => 'required|string'
        ]);

        $validated['user_id'] = $user->id;

        Softskill::create($validated);

        return response()->json(['message' => 'Softskills adicionadas com sucesso!'], 201);
    }

    public function updateSoftSkill(Request $request, $id){
        $guard = Auth::getDefaultDriver();//identifica o guard autenticado

        $user = Auth::guard($guard)->user(); //pega o usuário autenticado no guard

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $user_id = $user->id;


        $softSkill = Softskill::where('id', $id)
        ->where('user_id', $user_id)
        ->first(); //busca a formação acadêmica pelo id do usuário autenticado

        if (!$softSkill) {
            return response()->json(['message' => 'Registro acadêmico não encontrado ou não pertence ao usuário.'], 404);
        }

        $validated = $request->validate([
            'descricao' => 'sometimes|required|string',
        ]);

        $softSkill->update($validated);

        return response()->json([
            'message' => 'Formação acadêmica atualizada com sucesso!',
            'soft_skill' => $softSkill
        ]);
    }

    public function destroySoftSkill($id){
        $guard = Auth::getDefaultDriver();//identifica o guard autenticado
        $user = auth()->guard($guard)->user();

        if(!$user){
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $user_id = $user->id;

        $softSkill = Softskill::where('id', $id)
        ->where('user_id', $user_id)
        ->first(); //busca a formação acadêmica pelo id do usuário autenticado

        if(!$softSkill){
            return response()->json(['message' => 'Formação acadêmica não encontrada.'], 404);
        }

        $softSkill->delete();

        return response()->json(['message' => 'Formação acadêmica excluída com sucesso!'], 200);
    }
}
