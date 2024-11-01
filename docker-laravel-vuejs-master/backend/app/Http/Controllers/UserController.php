<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'phone' => 'required|integer',
            'curriculum' => 'required|string|max:255',
            'is_recruiter' => 'required|boolean',
        ]);

        $user = User::create($array);

        
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso! ',
            'user'=>$user,
            ]); 
    }

//     public function login(Request $request): JsonResponse
//     {
//         $credentials = $request->only('email', 'password');

//         if (Auth::attempt($credentials)) {
//             $user = Auth::user();
//             $recruiter = Auth::recruiter();

//             if ($user->is_recruiter === 'false'){

//                 $token = $user->createToken('userToken')->plainTextToken;

//             } else if ($recruiter->is_recruiter === 'true') {

//                 $token = $recruiter->createToken('recruiterToken')->plainTextToken;

//             } else {
//                 return response()->json(['ERROR, Type nao encontrado']);
//             }

//             return response()->json([

//                 'token'=> $token,
//                 'user' => $user
//         ]);
//     }

//         return response()->json ([
//             'error' => 'credencais invalidas'
//         ]);
// }

public function login(Request $request): JsonResponse
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Credenciais inválidas'], 401);
    }

    /** @var User $user */
    $user = Auth::user();

    // Define o nome do token com base no tipo de usuário
    $tokenName = $user->isRecruiter() ? 'recruiterToken' : 'userToken';
    $token = $user->createToken($tokenName)->plainTextToken;

    return response()->json([
        'message' => 'Login realizado com sucesso!',
        'token' => $token,
        'user' => $user,
    ]);
}
}
