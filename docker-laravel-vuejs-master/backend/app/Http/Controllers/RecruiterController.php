<?php

namespace App\Http\Controllers;

use App\Models\Application;
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
            'cnpj' => 'required|string|max:14|unique:recruiters',
            'social_name' => 'required|string|max:100',
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

        if ($request->hasFile('perfilPicture')) {
            $path = $request->file('perfilPicture')->store('photos', 'public');
            $array['perfilPicture'] = $path;
        }


        $recruiter = Recruiter::create($array);


        return response()->json([
            'message' => 'Recrutador cadastrado com sucesso! ',
            'recruiter'=>$recruiter,
            ]);
    }


    public function getRecruiterVacancies()
    {
        $recruiter = Auth::user();

        if (!$recruiter) {
            return response()->json(['message' => 'Usuário não autenticado. Faça login como recrutador.'], 401);
        }

        return response()->json([
            'message' => 'Vagas encontradas com sucesso!',
            'vacancies' => $recruiter->vacancies,
        ]);
    }

 



    public function update(Request $request, $id){

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado. Faça login como recrutador.'], 401);
        }

        $recruiter = Recruiter::where('id', $id)->where('id', $user->id)->first();

        if (!$recruiter) {
            return response()->json([
                'message' => 'Você não é autenticado para atualizar esse perfil.',
            ], 404);
        }

        $array = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:14',
            'social_name' => 'nullable|string|max:100',
            'cep' => 'nullable|string|max:8',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'is_recruiter' => 'nullable|boolean',
            'password' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:100',
            'perfilPicture' => 'string',
            'phone' => 'nullable|string|max:11',
        ]);

        $recruiter = Recruiter::find($id);

        $array['password'] = Hash::make($array['password']);

        $recruiter->update($array);

        return response()->json([
            'message' => 'Recrutador atualizado com sucesso!',
            'recruiter' => $recruiter,
        ], 201);

        $recruiter->save();

    }


    public function getRecruiterProfile(Request $request)
    {
        // Verifica se o usuário está autenticado com o guard de recrutador
        $recruiter = auth()->user();

        // Verifica se o recrutador está autenticado
        if (!$recruiter) {
            return response()->json([
                'message' => 'Acesso negado. Usuário não autenticado.'
            ], 401);
        }

        // Carrega todos os relacionamentos que você deseja retornar com os dados do recrutador
        $recruiter = Recruiter::with(['vacancies'])->find($recruiter->id);

        // Retorna todos os dados do recrutador com relacionamentos
        return response()->json($recruiter, 200);
    }
}
// preciso fazer a requisição para verificar se a empresa está mexendo com as próprias vagas, não com as de outras empresas
