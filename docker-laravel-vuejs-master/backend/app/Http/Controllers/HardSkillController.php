<?php

namespace App\Http\Controllers;

use App\Models\Hardskill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function updateHardSkill(Request $request,$id)
    {
        $user = Auth::user(); // Obter o usuário autenticado

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $hardSkill = Hardskill::where('id', $id)->where('user_id', $user->id)->first();

        if (!$hardSkill) {
            return response()->json([
                'message' => 'Hard skill não encontrada ou você não tem permissão para editá-la.',
            ], 404);
        }

        $validated = $request->validate([
            'descricao' => 'sometimes|required|string',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Hard skill atualizado com sucesso!',
            'hard_skill' => $validated,
            'user'=> $user
        ]);
    }


    public function destroyHardSkill($id){
        $guard = Auth::getDefaultDriver();//identifica o guard autenticado
        $user = auth()->guard($guard)->user();

        if(!$user){
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $user_id = $user->id;

        $hardSkill = Hardskill::where('id', $id)
        ->where('user_id', $user_id)
        ->first(); //busca a formação acadêmica pelo id do usuário autenticado

        if(!$hardSkill){
            return response()->json(['message' => 'Formação acadêmica não encontrada.'], 404);
        }

        $hardSkill->delete();

        return response()->json(['message' => 'Formação acadêmica excluída com sucesso!'], 200);
    }


}
