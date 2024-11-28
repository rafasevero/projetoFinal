<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Models\Application; // Adicione isso para importar o modelo Application
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
            'date_of_birth' => ['required', 'date', function ($attribute, $value, $fail) {
            if (Carbon::parse($value)->age < 16) {
                $fail('Você deve ter pelo menos 16 anos.');
            }
            }],
            'cpf' => 'required|string|max:11|unique:users',
            'cep' => 'required|string|max:8',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
            'phone' => 'required|string|max:11',
            'is_recruiter' => 'required|boolean',
            'perfilPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        } elseif (Auth::guard('recruiter')->attempt($credentials)) {
            $recruiter = Auth::guard('recruiter')->user();
            $token = $recruiter->createToken('recruiterToken')->plainTextToken;

            return response()->json([
                'message' => 'Recrutador autenticado com sucesso!',
                'token' => $token,
                'role' => $recruiter->is_recruiter ? 'recruiter' : 'user', // Adiciona o tipo de usuário

            ], 200);
    } else{
        return response()->json(['message' => 'Falha na autenticação do usuário'], 401);
    }

    }

    public function getUserProfile(){
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'message' => 'Acesso negadoo. Usuário não autenticado.'
            ], 401);
        }

        $user = User::find($user->id);

        return response()->json($user, 200);

    }

    public function update(Request $request,$id){

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado. Faça login como candidato.'], 401);
        }

        $user = User::where('id',$id)->where('id', $user->id)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Você não é autenticado para atualizar este perfil.',
            ], 404);
        }

        $array = $request->validate([
            'full_name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email',// Garantindo e-mails únicos
            'date_of_birth' => 'nullable|date',
            'cpf' => 'nullable|string|max:11',
            'cep' => 'nullable|string|max:8',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'phone' => 'nullable|string|max:11',
            'is_recruiter' => 'nullable|boolean',
            'perfilPicture' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('perfilPicture')) {
            // Exclui a imagem antiga, se existir
            if ($user->perfilPicture) {
                Storage::delete('public/' . $user->perfilPicture);
            }

            // Faz o upload da nova imagem
            $path = $request->file('perfilPicture')->store('perfil_pictures', 'public');
            $array['perfilPicture'] = $path;
        }

        $user = User::find($id);
      
        $user->update($array);

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'user' => $user,
        ]);

        $user->save();
    }

    public function getVacanciesForUser()
    {
        // Obter o usuário autenticado
        $user = auth()->user();

        // Verificar se o usuário está autenticado
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado!'], 401);
        }

        // Buscar todas as candidaturas feitas pelo usuário e carregar a vaga associada
        $applications = Application::where('user_id', $user->id)
            ->with('vacancy') // Carregar o relacionamento 'vacancy' junto com as candidaturas
            ->get();

        // Verificar se o usuário não tem candidaturas
        if ($applications->isEmpty()) {
            return response()->json(['message' => 'Você ainda não se candidatou a nenhuma vaga.'], 404);
        }

        // Retornar as candidaturas e as informações da vaga associada
        return response()->json(['applications' => $applications], 200);
    }


    public function logout(){

        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Logout realizado com sucesso!']);
        }

        return response()->json(['message' => 'Usuário não autenticado.'], 401);
    }
}
