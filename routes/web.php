<?php

use App\Http\Controllers\PaginasController;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// if (Auth::check()) {
//     // The user is logged in...
//     $usuario = Auth::user()->name;
// } else {
//     $usuario = null;
// }
//;
//$usuario_name = $usuario->name;
Route::get('/', function () {
    return view('welcome');
});


// Route::get('/inicio', function () {
//     return view('inicio');
// });
Route::get('/inicio', [PaginasController::class,'inicio']) ->name('inicio');
Route::get('/feedaback', [PaginasController::class,'feedback']) ->name('feedback');
Route::get('/info', [PaginasController::class,'info']) ->name('info');
Route::get('/contacto', [PaginasController::class,'contacto'])->name('contacto');
Route::post('/contacto', [PaginasController::class, 'recibeContacto'])->name('recibe-contacto');

Route::get('descargar-archivo/{persona}', [PersonaController::class, 'descargarArchivo'])->name('descargar');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('persona', PersonaController::class);
//Route::get('/persona', [PersonaController::class,'index']) ->name('persona.listado');
//Route::get('/persona/create', [PersonaController::class,'create']);
//Route::post('/persona/create', [PersonaController::class,'store']);
