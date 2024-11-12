<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $array =  $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',// Garantindo e-mails únicos
            'password' => 'required|string|min:8|max:100',
            'date_of_birth' => 'required|date',
            'cpf' => 'required|string|max:11',
            'cep' => 'required|string|max:8',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
            'phone' => 'required|string|max:11',
            'is_recruiter' => 'required|boolean',
            'perfilPicture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $array['password'] = Hash::make($array['password']);

        $user = User::create($array);


        return response()->json([
            'message' => 'Usuário cadastrado com sucesso! ',
            'user'=>$user,
            ]);
    }


    public function login(Request $request):JsonResponse
    {
    $credentials = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|max:100',
    ]);

    if (Auth::guard('user')->attempt($credentials)) {
        $user = Auth::guard('user')->user();
        $token = $user->createToken('userToken')->plainTextToken;

        return response()->json([
            'message' => 'Candidato autenticado com sucesso!',
            'token' => $token,
            'role' => $user->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário

        ], 200);
    }

    elseif (Auth::guard('recruiter')->attempt($credentials)) {
        $recruiter = Auth::guard('recruiter')->user();
        $token = $recruiter->createToken('recruiterToken')->plainTextToken;

        return response()->json([
            'message' => 'Recrutador autenticado com sucesso!',
            'token' => $token,
            'role' => $recruiter->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário

        ], 200);
    }
    else{
        return response()->json(['message' => 'Falha na autenticação do usuário'], 401);
    }



    }

    public function destroy(){
        auth()->guard('user')->logout();
        return response()->json(['message' => 'Logout efetuado com sucesso!']);
    }

    public function getUserProfile(Request $request){
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Acesso negado. Usuário não autenticado.'
            ], 401);
        }

        $user = User::find($user->id);

        return response()->json($user, 200);

    }
    //tenho que criar a função de atualizar o perfil do user

}
