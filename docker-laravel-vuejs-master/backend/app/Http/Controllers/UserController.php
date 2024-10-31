<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $array =  $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',    
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
}
