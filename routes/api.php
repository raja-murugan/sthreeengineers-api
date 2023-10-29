<?php

use App\Http\Controllers\Api\EngineerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;

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
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::middleware('auth:sanctum')->get('/engineer', [EngineerController::class, 'index']);

    Route::middleware('auth:sanctum')->post('/create/engineer', [EngineerController::class, 'store']);

    Route::middleware('auth:sanctum')->get('/engineer/show/{id}', [EngineerController::class, 'show']);

    Route::middleware('auth:sanctum')->put('/engineer/update/{id}', [EngineerController::class, 'update']);

    Route::middleware('auth:sanctum')->put('/engineer/{id}/delete', [EngineerController::class, 'destroy']);
});
