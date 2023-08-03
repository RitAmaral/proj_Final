<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\DB; //importar

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//está aqui por default, não mexemos neste. home controller class com nome index, para ser reconhecido do outro lado chamamos name('home')
//este vai para a página home.blade.php

/*---------------------filme----------------*/

Route::get('/filme', [App\Http\Controllers\HomeController::class, 'index'])->name('filme.index'); 
//1º criamos uma rota (esta em cima) para o index, que está no home controller. Ir à página do home controller: (public function index()).

//rota para adicionar filme (é feito em 2 partes, adiconar e guardar que aparece a rota embaixo): 
Route::get('/filme/adicionar', [App\Http\Controllers\HomeController::class, 'create'])->name('filme.create');

//rota para store/guardar filme: //aqui usa-se o post
Route::post('/filme/adicionar', [App\Http\Controllers\HomeController::class, 'store'])->name('filme.store');

//rota para ver, get = buscar dentro da pasta filme, pelo id. Ir depois ao home controller, e função show. colocar name('filme.show'), que é a página que vamos criar.
Route::get('/filme/show/{id_filme}', [App\Http\Controllers\HomeController::class, 'show'])->name('filme.show');

//rota para editar:
Route::get('/filme/edit/{id_filme}', [App\Http\Controllers\HomeController::class, 'edit'])->name('filme.edit'); //agora vamos criar route para editar

//rota para gravar a alteração: (alteramos de get para put, porque vai colocar na base de dados, não buscar da base de dados)
Route::put('/filme/update/{id_filme}', [App\Http\Controllers\HomeController::class, 'update'])->name('filme.update');

//rota para eliminar: aqui usamos delete
Route::delete('/filme/delete/{id_filme}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('filme.delete');

/*---------------------user----------------*/

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index'); 
//1º criamos uma rota (esta em cima) para o index, que está no user controller. Ir à página do user controller: (public function index()).

//rota para adicionar utilizador (é feito em 2 partes, adiconar e guardar): 
Route::get('/user/adicionar', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');

//rota para store/guardar utilizador: //aqui usa-se o post
Route::post('/user/adicionar', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');

//agora criamos uma nova route, get = buscar dentro da pasta user, pelo campo id. Ir depois ao user controller, e função show. colocar name('user.show'), que é a página que vamos criar.
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');

//rota para editar:
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit'); //agora vamos criar route para editar

//rota para gravar a alteração: (alteramos de get para put, porque vai colocar na base de dados, não buscar da base de dados)
Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

//rota para eliminar: aqui usamos delete
Route::delete('/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.delete');

//rota para fazer o logout:
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


/*---------------------interveniente----------------*/

//1º criamos uma rota (esta em baixo) para o index, que está no interveniente controller. Ir à página do interveniente controller: (public function index()).
Route::get('/interveniente', [App\Http\Controllers\IntervenienteController::class, 'index'])->name('interveniente.index');

//buscar dentro da pasta interveniente, pelo campo id. Ir depois ao interveniente controller, e função show. colocar name('interveniente.show'), que é a página que vamos criar.
Route::get('/interveniente/{id}', [App\Http\Controllers\IntervenienteController::class, 'show'])->name('interveniente.show');


/*---------------------comentários----------------*/

Route::post('/comentarios', [App\Http\Controllers\ComentarioController::class, 'store'])->name('comentarios.store');


//grupo de rotas que requerem autenticação
Route::group(['middleware' => 'auth'], function () {
    //rotas para comentários
    Route::post('/comentarios', [App\Http\Controllers\ComentarioController::class, 'store'])->name('comentarios.store'); });

//rota para perfil do user
Route::get('/perfil', [App\Http\Controllers\UserController::class, 'perfil'])->name('perfil')->middleware('auth');

//rota para adicionar interveniente preferido
Route::post('/adicionar-interv-preferido', [App\Http\Controllers\IntervenienteController::class, 'adicionarIntervenientePreferido'])->name('adicionar.interv.preferido');