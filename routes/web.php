<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Models\Empleado;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
/*
Route::get('/empleado', function () {
    return view('Empleado.index'); //Carpeta . archivo php
});


//solo peudo acceder a create
Route::get('empleado/create', [EmpleadoController::class,'create']);
de esta forma accedo, a travez de ese URL a ese metodo de EmpleadoController
*/


// puedo acceder a todos los metodos de la controladora
// middleware: es un elemento que usamos como la vía para conectar 
// dos aplicaciones o dos partes, su función es pasar datos
// entre ellas o de un lado a otro a la vez que valida que haya un usuario logeado
Route::resource('empleado', EmpleadoController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');
/*
Route::prefix('auth')->group(function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});
*/
Route::group(['middleware'=>'auth'], function(){
    
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
    //de esta forma si la autentificacion es valida (se logea un usuario existente), es redirigido a: 
    //Route::get(URL, [controladora, metodo])->???
});