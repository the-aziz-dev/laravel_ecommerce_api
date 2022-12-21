<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
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

Route::apiResource('/brands', BrandController::class);
Route::apiResource('/categories', CategoryController::class);
Route::get('/categories/{category}/parent', [CategoryController::class, 'showParent']);
Route::get('/categories/{category}/children', [CategoryController::class, 'indexChildren']);
