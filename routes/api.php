<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ProfessorsController;

Route::get('/', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 //alunos rotas
 Route::get('/professores', [ProfessorsController::class, 'index']);
 Route::post('/professores', [ProfessorsController::class, 'store']);
 Route::get('/professores/{id}', [ProfessorsController::class, 'show']);
 Route::put('/professores/{id}', [ProfessorsController::class, 'update']);
 Route::delete('/professores/{id}', [ProfessorsController::class, 'destroy']);
  
 Route::get('/alunos', [AlunosController::class, 'index']);
 Route::post('/alunos', [AlunosController::class, 'store']);
 Route::get('/alunos/{id}', [AlunosController::class, 'show']);
 Route::put('/alunos/{id}', [AlunosController::class, 'update']);
 Route::delete('/alunos/{id}', [AlunosController::class, 'destroy']);