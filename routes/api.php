<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyReviewController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserReviewController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::apiResource('companies', CompanyController::class)
    ->missing(fn() => response(status: 404));
Route::apiResource('companies.reviews', CompanyReviewController::class)
    ->missing(fn() => response(status: 404));

Route::apiResource('users', UserController::class)
    ->missing(fn() => response(status: 404));
Route::apiResource('users.reviews', UserReviewController::class)
    ->missing(fn() => response(status: 404));

Route::apiResource('reviews', ReviewController::class)
    ->missing(fn() => response(status: 404));
