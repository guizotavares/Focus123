<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\DashboardController;

/* ---------- Públicas ---------- */
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth', [AuthController::class, 'store'])->name('auth.store');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Alias: o middleware Authenticate do Laravel procura a rota nomeada 'login'
Route::get('/login', fn () => redirect()->route('auth.index'))->name('login');

/* ---------- Protegidas ---------- */
Route::middleware('autenticacao')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/', [TaskController::class, 'index'])->name('home');
    Route::resource('tasks', TaskController::class);
    Route::get('/filterTipos', [TaskController::class, 'filterTipos'])->name('tasks.filterTipos');
    Route::get('/filterConcluidas', [TaskController::class, 'filterConcluidas'])->name('tasks.filterConcluidas');
    Route::post('/tasks/{id}/concluir', [TaskController::class, 'concluir'])->name('tasks.concluir');
    Route::get('/filterEntreDatas', [TaskController::class, 'filterEntreDatas'])->name('tasks.filterEntreDatas');
    Route::get('/filterPorData', [TaskController::class, 'filterPorData'])->name('tasks.filterPorData');

    Route::get('/calendario', fn () => view('tasks.calendar.calendario'))->name('calendario');

    Route::get('/conta', [ContaController::class, 'show'])->name('conta.show');
    Route::get('/conta/editar', [ContaController::class, 'edit'])->name('conta.edit');
    Route::put('/conta', [ContaController::class, 'update'])->name('conta.update');

    Route::resource('hobbies', HobbyController::class);
    Route::resource('diary', DiaryController::class);
});