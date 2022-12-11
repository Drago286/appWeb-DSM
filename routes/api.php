<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ResumenOrdenController;
use App\Http\Controllers\ResumenOrdenProductoController;
use App\Http\Controllers\ImageUploadController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::resource('mesas', MesaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('resumen_ordens', ResumenOrdenController::class);
Route::resource('resumen_orden_productos', ResumenOrdenProductoController::class);
Route::resource('imagens', ImageUploadController::class);
//Route::resource('saveOrder', ResumenOrdenController::class);

Route::post('saveOrder', [ResumenOrdenController::class, 'saveOrder']);
Route::post('/upload', [ImageUploadController::class, 'uploadImage'])->name('images.upload');
