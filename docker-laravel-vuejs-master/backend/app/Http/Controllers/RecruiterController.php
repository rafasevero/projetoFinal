<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;

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
}
