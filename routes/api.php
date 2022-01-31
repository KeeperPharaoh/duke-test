<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CheckController;
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

Route::prefix('auth')
     ->group(function () {
         Route::post('register', [AuthController::class, 'register']);
         Route::post('login', [AuthController::class, 'login']);
         Route::get('logout', [AuthController::class, 'logout'])
              ->middleware('auth:sanctum');
     });
Route::get('checks', [CheckController::class, 'show']);
Route::post('check/unload', [CheckController::class, 'unload'])->middleware('auth:sanctum');
