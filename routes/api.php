<?php

use App\Http\Controllers\FarmerController;
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

Route::post('/verify-cpf', [FarmerController::class, 'verifyCPF']);
Route::post('/confirm-user', [FarmerController::class, 'confirmUser']);
Route::post('/download-second-file', [FarmerController::class, 'downloadSecondFile']);
Route::post('/save-phone', [FarmerController::class, 'savePhone']);

