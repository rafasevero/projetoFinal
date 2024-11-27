<?php

use App\Http\Controllers\AcademicBackgroundController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\HardSkillController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\SoftskillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('user')->group(function () {
    Route::get('/pullAuth', function(Request $request){
        return $request->user();
    })->middleware('auth:sanctum');
    Route::post('/user_register',[UserController::class, 'register'])->name('users.register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'getUserProfile']);
    Route::middleware('auth:sanctum')->put('/update/{id}',[UserController::class, 'update']);
    Route::middleware('auth:sanctum')->post('/storeAcademic',[AcademicBackgroundController::class,'storeAcademic']);
    Route::middleware('auth:sanctum')->post('/storeCurriculum',[CurriculumController::class,'storeCurriculum']);
    Route::middleware('auth:sanctum')->post('/storeSoftSkill',[SoftskillController::class,'storeSoftSkill']);
    Route::middleware('auth:sanctum')->post('/storeHardSkill',[HardSkillController::class,'storeHardSkill']);
    Route::middleware('auth:sanctum')->put('/updateAcademic/{id}',[AcademicBackgroundController::class,'updateAcademic']);
    Route::middleware('auth:sanctum')->post('/deleteAcademic/{id}',[AcademicBackgroundController::class, 'destroyAcademic']);
    Route::middleware('auth:sanctum')->post('/applyForVacancy/{vacancy_id}',[ApplicationController::class, 'applyForJob']);
    Route::middleware('auth:sanctum')->put('/updateHardSkill/{id}',[HardSkillController::class, 'updateHardSkill']);//testar
    Route::middleware('auth:sanctum')->post('/deleteHardSkill/{id}',[HardSkillController::class, 'destroyHardSkill']);//testar
    Route::middleware('auth:sanctum')->put('/updateSoftSkill/{id}',[SoftskillController::class, 'updateSoftSkill']);//testar
    Route::middleware('auth:sanctum')->post('/deleteSoftSkill/{id}',[SoftskillController::class, 'destroySoftSkill']);//testar
    Route::middleware('auth:sanctum')->put('/updateCurriculum/{id}',[CurriculumController::class, 'updateCurriculum']);//testar
    Route::middleware('auth:sanctum')->post('/deleteCurriculum/{id}',[CurriculumController::class, 'destroyCurriculum']);//testar
    Route::middleware('auth:sanctum')->get('/getVacanciesForUser',[UserController::class, 'getVacanciesForUser']);

});


Route::prefix('recruiter')->group(function () {
    Route::post('/recruiter_register',[RecruiterController ::class, 'registerRecruiter'])->name('recruiters.register');
    Route::post('/login', [RecruiterController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->post('/vacancy_register',[VacancyController::class, 'registerVacancy']);
    Route::middleware('auth:sanctum')->put('/updateVacancy/{id}',[VacancyController::class, 'updateVacancy']);
    Route::middleware('auth:sanctum')->get('/profile', [RecruiterController::class, 'getRecruiterProfile']);
    Route::middleware('auth:sanctum')->put('/update/{id}',[RecruiterController::class, 'update']);
    Route::middleware('auth:sanctum')->get('/getVacancies', [RecruiterController::class, 'getRecruiterVacancies']);
    Route::middleware('auth:sanctum')->get('/getUsersForVacancies/{ApplyId}',[ApplicationController::class, 'getUsersForVacancies']);
});

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);


Route::get('/vacancies',[VacancyController::class,'vacancies'])->name('vacancies');
Route::get('index_vacancies',[VacancyController::class,'index_vacancies'])->name('vacancies.index');
