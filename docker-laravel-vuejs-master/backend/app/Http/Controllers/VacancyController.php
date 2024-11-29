<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Recruiter;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    public function registerVacancy(Request $request)
    {

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
            'salary' => 'required|string|max:50',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'min_age' => 'integer'
        ]);

        $array['recruiter_id'] = $recruiter->id;

        $array['company'] = $recruiter->company_name;

        if ($request->hasFile('company_logo')) {
            $path = $request->file('company_logo')->store('company_logos', 'public');
            $array['company_logo'] = $path;
        }

        $array['creation_date'] = now();


        $vacancy = Vacancies::create($array);

        return response()->json([
            'message' => 'Vaga cadastrada com sucesso! ',
            'vacancy' => $vacancy,
            'recruiter' => $recruiter,
        ]);
    }

    public function index_vacancies()
    {

        $vacancies = Vacancies::all();
        return response()->json([
            'message' => 'Lista de vagas encontrada com sucesso!',
            'vacancies' => $vacancies,

        ]);
    }

    public function updateVacancy(Request $request, $id)
    {

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
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'min_age' => 'integer'
        ]);

        if ($request->hasFile('company_logo')) {
            // deleta a foto anterior
            if ($vacancies->company_logo) {
                Storage::delete('public/' . $vacancies->company_logo);
            }

            $path = $request->file('company_logo')->store('company_logos', 'public');
            $array['company_logo'] = $path;
        }


        $vacancies->update($array);

        return response()->json([
            'message' => 'Vaga atualizada com sucesso!',
            'vacancies' => $vacancies,
        ]);
    }

    public function destroyVacancy($id)
    {


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

        $vacancies->delete();

        return response()->json([
            'message' => 'Vaga excluída com sucesso!',
        ], 200);
    }
}
