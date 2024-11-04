<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RecruiterController extends Controller
{
    public function registerRecruiter(Request $request){
        $array =  $request->validate([
           'company_name' => 'required|string|max:100',
            'cnpj' => 'required|string|max:14',
            'social_name' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'is_recruiter' => 'required|boolean',
            'password' => 'required|string|max:255',
            'email' => 'required|string|email|max:100',
        ]);

        $recruiter = Recruiter::create($array);

        
        return response()->json([
            'message' => 'Recrutador cadastrado com sucesso! ',
            'recruiter'=>$recruiter,
            ]); 
    }

    public function loginRecruiter(Request $request)
    {
    $credentials = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|max:100',
    ]);

    $recruiter = Recruiter::where('email', $credentials['email'])->first();

    if ($recruiter && Hash::check($credentials['password'], $recruiter->password)) {
        // Gera o token tanto para recrutadores quanto para usuários comuns
        $token = $recruiter->createToken('API Token')->plainTextToken;
        
        return response()->json([
            'message' => 'Login efetuado com sucesso!',
            'recruiter' => $recruiter,
            'token' => $token,
            'role' => $recruiter->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário
        ]);
    } else {
        return response()->json([
            'message' => 'Login não efetuado!',
            'recruiter' => null,
        ]);
    }
    }
}
