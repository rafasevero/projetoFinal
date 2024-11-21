<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function updateCurriculum(Request $request, $id){
        $guard = Auth::getDefaultDriver();//identifica o guard autenticado

        $user = Auth::guard($guard)->user(); //pega o usuário autenticado no guard

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $user_id = $user->id;


        $curriculum = Curriculum::where('id', $id)
        ->where('user_id', $user_id)
        ->first(); //busca a formação acadêmica pelo id do usuário autenticado

        if (!$curriculum) {
            return response()->json(['message' => 'Registro acadêmico não encontrado ou não pertence ao usuário.'], 404);
        }

        $validated = $request->validate([
            'file' => 'sometimes|required|file|mimes:pdf|max:10240',
        ]);

        $curriculum->update($validated);

        return response()->json([
            'message' => 'Formação acadêmica atualizada com sucesso!',
            'curriculum' => $curriculum
        ]);
    }

    public function destroyCurriculum($id){
        $guard = Auth::getDefaultDriver();//identifica o guard autenticado
        $user = auth()->guard($guard)->user();

        if(!$user){
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $user_id = $user->id;

        $curriculum = Curriculum::where('id', $id)
        ->where('user_id', $user_id)
        ->first(); //busca a formação acadêmica pelo id do usuário autenticado

        if(!$curriculum){
            return response()->json(['message' => 'Formação acadêmica não encontrada.'], 404);
        }

        $curriculum->delete();

        return response()->json(['message' => 'Formação acadêmica excluída com sucesso!'], 200);
    }
}
