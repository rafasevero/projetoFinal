<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RecruiterController;
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
    Route::post('/user_register',[UserController::class, 'register'])->name('users.register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->get('/profile', [UserController::class, 'getUserProfile']);
    Route::middleware('auth:sanctum')->put('/update/{id}',[UserController::class, 'update']);
    Route::middleware('auth:sanctum')->post('/applyForJob/{vacancy_id}',[ApplicationController::class, 'applyForJob']);

});
Route::prefix('recruiter')->group(function () {
    Route::post('/recruiter_register',[RecruiterController ::class, 'registerRecruiter'])->name('recruiters.register');
    Route::post('/login', [RecruiterController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->post('/vacancy_register',[VacancyController::class, 'registerVacancy']);
    Route::middleware('auth:sanctum')->put('/updateVacancy/{id}',[VacancyController::class, 'updateVacancy']);
    Route::middleware('auth:sanctum')->get('/profile', [RecruiterController::class, 'getRecruiterProfile']);
    Route::middleware('auth:sanctum')->put('/update/{id}',[RecruiterController::class, 'update']);
});



Route::get('/vacancies',[VacancyController::class,'vacancies'])->name('vacancies');
Route::get('index_vacancies',[VacancyController::class,'index_vacancies'])->name('vacancies.index');
Route::get('/recruiters/{recruiterId}/vacancies', [RecruiterController::class, 'getRecruiterVacancies']);
