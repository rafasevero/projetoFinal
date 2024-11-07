<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function registerVacancy(Request $request){
        $array = $request->validate([
            'vacancy_name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'requirements' => 'required|string|max:255',
            'location' => 'required|string|max:100',
            'work_modality' => 'required|string|max:50',
            'creation_date' => 'required|date',
            'company' => 'required|string|max:100',
            'salary' => 'required|string|max:50',
            'company_logo' => 'string',
        ]);

        $recruiter = Auth::user()->recruiter;
        $array['recruiter_id'] = $recruiter->id;
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
}
