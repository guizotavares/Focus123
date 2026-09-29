<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Rotas públicas
|--------------------------------------------------------------------------
*/
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth', [AuthController::class, 'store'])->name('auth.store');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

/*
|--------------------------------------------------------------------------
| Rotina de Login (atividade — Auth::attempt / Hash::make / User model)
|--------------------------------------------------------------------------
| Sistema de autenticação independente, usando o Auth nativo do Laravel
| (tabela "users", guard padrão). Não interfere no fluxo de sessão do
| AuthController (tabela "usuarios") usado pelo resto do app.
*/

// Acessar a view para a criação do usuário
Route::get('/usuario', function () {
    return view('usuario');
});

// Chamar o store para criar o usuário
Route::post('/usuario-criar', [UserController::class, 'store']);

// View de login (GET) — usa o nome 'login', que o middleware Authenticate
// usa como destino de redirecionamento quando o acesso não é autenticado
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/fazerLogin', [UserController::class, 'fazerLogin']);

Route::get('/logout', [UserController::class, 'fazerLogOut']);

// Renomeada de "/dashboard" para "/painel-administrativo": a atividade de
// login usava "/dashboard", mas essa URI já é do DashboardController de
// gráficos (dentro do grupo 'autenticacao' abaixo). Duas rotas GET com a
// mesma URI colidem — só a primeira registrada seria realmente usada.
Route::get('/painel-administrativo', function () {
    return view('paineladministrativo.dashboard');
})->middleware(Authenticate::class)->name('painel.dashboard');

/*
|--------------------------------------------------------------------------
| Rotas protegidas (sessão "usuarios" / middleware "autenticacao")
|--------------------------------------------------------------------------
*/
Route::middleware('autenticacao')->group(function () {

    // Página inicial — tarefas
    Route::get('/', [TaskController::class, 'index'])->name('home');
    Route::resource('tasks', TaskController::class);
    Route::get('/filterTipos', [TaskController::class, 'filterTipos'])->name('tasks.filterTipos');
    Route::get('/filterConcluidas', [TaskController::class, 'filterConcluidas'])->name('tasks.filterConcluidas');
    Route::post('/tasks/{id}/concluir', [TaskController::class, 'concluir'])->name('tasks.concluir');
    Route::get('/filterEntreDatas', [TaskController::class, 'filterEntreDatas'])->name('tasks.filterEntreDatas');
    Route::get('/filterPorData', [TaskController::class, 'filterPorData'])->name('tasks.filterPorData');

    // Calendário
    Route::get('/calendario', function () {
        return view('tasks.calendar.calendario');
    })->name('calendario');

    // Minha Conta
    Route::get('/conta', [ContaController::class, 'show'])->name('conta.show');
    Route::get('/conta/editar', [ContaController::class, 'edit'])->name('conta.edit');
    Route::put('/conta', [ContaController::class, 'update'])->name('conta.update');

    Route::resource('hobbies', HobbyController::class);
    Route::resource('diary', DiaryController::class);

    // Dashboard de gráficos (ECharts) — dados reais do banco
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
