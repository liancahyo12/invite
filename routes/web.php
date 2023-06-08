<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomentarController;

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

Route::prefix('/api')->group(function () {

Route::prefix('/comment')->controller(KomentarController::class)->group(function () {
    Route::get('/all', 'all');
    Route::get('/', 'index_api');
    Route::post('/', 'create_api');
    Route::options('/');

    Route::get('/{id}', 'show_api');
    Route::delete('/{id}', 'destroy_api');
    Route::options('/{id}');
});
});
