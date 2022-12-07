<?php

use App\Http\Controllers\ResumenOrdenController;
use GrahamCampbell\ResultType\Result;
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

// Route::get('/', function () {
//     return view('administrarOrdenes');
// });

Route::resource('/', ResumenOrdenController::class);
Route::get('/detalleOrden', [ResumenOrdenController::class, 'detallesOrden']);


// Route::get('/Pedidos', [ResumenOrdenController::class, 'listar_pedidos'])->name('listar_pedidos');
// Route::post('/change/state', [ResumenOrdenController::class, 'atender_orden'])->name('atender_orden');
