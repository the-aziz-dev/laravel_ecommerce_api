<?php

use App\Http\Controllers\BrandController;
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

Route::controller(BrandController::class)->group(function () {
    Route::get('/brands', 'index');
    Route::post('/brand', 'store');
    Route::get('/brands/{brand}', 'show');
    Route::put('/brands/{brand}', 'update');
    Route::delete('/brands/{brand}', 'destroy');
});
