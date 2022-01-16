<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\AuthController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function (){
        Route::get('/', [UserController::class, 'list']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'delete']);
    });

    Route::prefix('gifts')->group(function () {

        Route::get('/', [GiftController::class, 'list']);
        Route::get('/{gift}', [GiftController::class, 'show']);
        Route::get('/{gift}/picture', [GiftController::class, 'downloadPicture']);
        Route::post('/', [GiftController::class, 'create']);
        Route::put('/{gift}', [GiftController::class, 'update']);
        Route::delete('/{gift}', [GiftController::class, 'delete']);
    });
});
