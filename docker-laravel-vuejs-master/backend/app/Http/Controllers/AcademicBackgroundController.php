<?php

namespace App\Http\Controllers;

use App\Models\Academic_background;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function updateAcademic(Request $request, $id){

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $academicBackground = Academic_background::where('id', $id)->where('user_id', $user->id)->first();

        if (!$academicBackground) {
            return response()->json([
                'message' => 'Formação acadêmica não encontrada ou você não tem permissão para editá-la.',
            ], 404);
        }

        $validated = $request->validate([
            'institution' => 'sometimes|required|string',
            'course' => 'sometimes|required|string',
            'education_level' => 'sometimes|required|string|in:fundamental incompleto,fundamental completo',
            'start_date' => 'sometimes|required|date',
            'completion_date' => 'sometimes|required|date',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Formação acadêmica atualizada com sucesso!',
            'academic_background' => $validated,
            'user'=> $user
        ]);
    }

    public function destroyAcademic($id){
        $guard = Auth::getDefaultDriver();//identifica o guard autenticado
        $user = auth()->guard($guard)->user();

        if(!$user){
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $user_id = $user->id;

        $academicBackground = Academic_background::where('id', $id)
        ->where('user_id', $user_id)
        ->first(); //busca a formação acadêmica pelo id do usuário autenticado

        if(!$academicBackground){
            return response()->json(['message' => 'Formação acadêmica não encontrada.'], 404);
        }

        $academicBackground->delete();

        return response()->json(['message' => 'Formação acadêmica excluída com sucesso!'], 200);
    }

}
