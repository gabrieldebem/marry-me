<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'create']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'delete']);

Route::group('/users', function (){
    Route::get('/giftLists', [UserController::class, 'list']);
    Route::get('/giftLists/{giftList}', [UserController::class, 'show']);
    Route::post('/giftLists', [UserController::class, 'create']);
    Route::put('/giftLists/{giftList}', [UserController::class, 'update']);
    Route::delete('/giftLists/{giftList}', [UserController::class, 'delete']);
});
