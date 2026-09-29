<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//TASKS
Route::get('/task', [TaskController::class, 'indexTasksApi']);
Route::post('/task', [TaskController::class, 'storeApi']);
Route::put('/task/{id}', [TaskController::class, 'updateApi']);
Route::delete('/task/{id}', [TaskController::class, 'destroyApi']);
Route::get('/task-qtd', [TaskController::class, 'countTask']);
Route::get('/task/{id}', [TaskController::class, 'showTask']);



//HOBBIES
Route::get('/hobbies', [HobbyController::class, 'apiIndex']);
Route::post('/hobbies', [HobbyController::class, 'apiStore']);
Route::get('/hobbies/{id}', [HobbyController::class, 'apiShow']);
Route::put('/hobbies/{id}', [HobbyController::class, 'apiUpdate']);
Route::delete('/hobbies/{id}', [HobbyController::class, 'apiDestroy']);

//conta
Route::get('/conta', [AuthController::class, 'indexUserApi']);
Route::post('/conta', [AuthController::class, 'storeApi']);
Route::put('/conta/{id}', [AuthController::class, 'updateUserApi']);
Route::delete('/conta/{id}', [AuthController::class, 'destroyUserApi']);
Route::get('/conta-qtd', [AuthController::class, 'countUsuario']);
Route::get('/usuario/id/{name}', [AuthController::class, 'idUsuarioApi']);

//diario
Route::get('/diary', [DiaryController::class, 'apiIndex']);
Route::post('/diary', [DiaryController::class, 'apiStore']);
Route::get('/diary/{id}', [DiaryController::class, 'apiShow']);
Route::put('/diary/{id}', [DiaryController::class, 'apiUpdate']);
Route::delete('/diary/{id}', [DiaryController::class, 'apiDestroy']);

