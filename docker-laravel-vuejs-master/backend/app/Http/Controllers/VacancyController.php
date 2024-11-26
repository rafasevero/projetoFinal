<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function registerVacancy(Request $request){

        $recruiter = Auth::user();

        if (!$recruiter) {
            return response()->json(['message' => 'Usuário não autenticado. Faça login como recrutador.'], 401);
        }


        $array = $request->validate([
            'vacancy_name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'requirements' => 'required|string|max:255',
            'location' => 'required|string|max:100',
            'work_modality' => 'required|string|max:50',
            'creation_date' => 'required|date',
            'salary' => 'required|string|max:50',
            'company_logo' => 'string',//'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
            'min_age' => 'integer'
        ]);

        $array['recruiter_id'] = $recruiter->id;

        $array['company'] = $recruiter->company_name;


        $vacancy = Vacancies::create($array);

        return response()->json([
            'message' => 'Vaga cadastrada com sucesso! ',
            'vacancy'=>$vacancy,
            'recruiter'=>$recruiter,
            ]);

    }

    public function index_vacancies(){

        $vacancies = Vacancies::all();
        return response()->json([
            'message' => 'Lista de vagas encontrada com sucesso!',
            'vacancies' => $vacancies,

        ]);
    }

    public function updateVacancy(Request $request, $id){

        $recruiter = Auth::user();

        if (!$recruiter) {
            return response()->json(['message' => 'Usuário não autenticado. Faça login como recrutador.'], 401);
        }

        $vacancies = Vacancies::where('id', $id)->where('recruiter_id', $recruiter->id)->first();

        if (!$vacancies) {
            return response()->json([
                'message' => 'Esta vaga não pertence à sua empresa.',
            ], 404);
        }

        $array = $request->validate([
            'vacancy_name' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
            'requirements' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:100',
            'work_modality' => 'nullable|string|max:50',
            'creation_date' => 'nullable|date',
            'company' => 'nullable|string|max:100',
            'salary' => 'nullable|string|max:50',
            'company_logo' => 'string',
            'min_age' => 'integer'
        ]);


        $vacancies->update($array);

        return response()->json([
            'message' => 'Vaga atualizada com sucesso!',
            'vacancies' => $vacancies,
        ]);
    }

    public function destroyVacancy($id){

        $vacancy = Vacancies::find($id);

        if (!$vacancy) {
            return response()->json([
                'message' => 'Vaga não encontrada!',
            ], 404);
        }

        if ($vacancy->recruiter_id !== auth('recruiter')->id()) {
            return response()->json([
                'message' => 'Você não tem permissão para excluir esta vaga!',
            ], 403);
        }

        $vacancy->delete();

        return response()->json([
            'message' => 'Vaga excluída com sucesso!',
        ]);
    }

}
