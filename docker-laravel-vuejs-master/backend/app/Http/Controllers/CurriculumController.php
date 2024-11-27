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
            'file' => 'string'//'required|file|mimes:pdf|max:10240'
        ]);

        $validated['user_id'] = $user->id;

        Curriculum::create($validated);

        return response()->json(['message' => 'Currículo anexado com sucesso!'], 201);
    }

    public function updateCurriculum(Request $request, $id){

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $curriculum = Curriculum::where('id', $id)->where('user_id', $user->id)->first();


        if (!$curriculum) {
            return response()->json([
                'message' => 'Curriculo não encontrada ou você não tem permissão para editá-la.',
            ], 404);
        }

        $validated = $request->validate([
            'file' => 'sometimes|required|string',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Hard skill atualizado com sucesso!',
            'hard_skill' => $validated,
            'user'=> $user
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
