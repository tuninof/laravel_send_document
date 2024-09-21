<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/verify-cpf', [UserController::class, 'verifyCPF']);
Route::post('/confirm-user', [UserController::class, 'confirmUser']);
Route::post('/download-second-file', [UserController::class, 'downloadSecondFile']);
Route::post('/save-phone', [UserController::class, 'savePhone']);

