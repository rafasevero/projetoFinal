<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Author;

class RecruiterController extends Controller
{
    public function registerRecruiter(Request $request){
        $array =  $request->validate([
           'company_name' => 'required|string|max:100',
            'cnpj' => 'required|string|max:14',
            'cep' => 'required|string|max:8',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
            'is_recruiter' => 'required|boolean',
            'password' => 'required|string|max:255',
            'email' => 'required|string|email|max:100',
            'perfilPicture' => 'string',
            'phone' => 'required|string|max:11',
        ]);

        $array['password'] = Hash::make($array['password']);
        
        $recruiter = Recruiter::create($array);


        return response()->json([
            'message' => 'Recrutador cadastrado com sucesso! ',
            'recruiter'=>$recruiter,
            ]);
    }

    public function login(Request $request):JsonResponse
    {
    $credentials = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|max:100',
    ]);

    if (Auth::guard('recruiter')->attempt($credentials)) {
        $recruiter = Auth::guard('recruiter')->user();
        $token = $recruiter->createToken('recruiterToken')->plainTextToken;

        return response()->json([
            'message' => 'Recrutador autenticado com sucesso!',
            'token' => $token,
            'role' => $recruiter->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário

        ], 200);
    }

    return response()->json(['message' => 'Recrutador não autenticado!'], 401);

    }

    public function getRecruiterVacancies($recruiterId)
{
    $recruiter = Recruiter::findOrFail($recruiterId);
    return response()->json([
        'message' => 'Vagas encontradas com sucesso!',
        'vacancies' => $recruiter->vacancies,
    ]);
}

    public function destroy(){
        auth()->guard('recruiter')->logout();
        return response()->json(['message' => 'Logout efetuado com sucesso!']);
    }


}
