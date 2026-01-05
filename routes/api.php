<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\LaporanApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/laporan-banjir/kirim', [LaporanApiController::class, 'store']);
    Route::get('/user-profile', function(Request $request) {
        return $request->user();
    });
});