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
            'curriculum' => 'required|string|max:255',
            'is_recruiter' => 'required|boolean',
            'perfilPicture' => 'string',
        ]);

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

    $user = User::where('email', $credentials['email'])->first();
    $recruiter = Recruiter::where('email', $credentials['email'])->first();


    if ($user && Hash::check($credentials['password'], $user->password)) {
        // Gera o token tanto para recrutadores quanto para usuários comuns
        $token = $user->createToken('UserToken')->plainTextToken;

        return response()->json([
            'message' => 'Login Candidato efetuado com sucesso!',
            'user' => $user,
            'token' => $token,
            'role' => $user->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário
        ]);
        }
        elseif ($recruiter && Hash::check($credentials['password'], $recruiter->password)) {
            // Gera o token tanto para recrutadores quanto para usuários comuns
            $token = $recruiter->createToken('RecruiterToken')->plainTextToken;

            return response()->json([
                'message' => 'Login Recrutador efetuado com sucesso!',
                'recruiter' => $recruiter,
                'token' => $token,
                'role' => $recruiter->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário
            ]);
        }
        else {
            return response()->json([
                'message' => 'Login não efetuado!',
                'user' => null,
                'recruiter' => null
            ]);
        }
}

}
