<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('companies.index');
});

Route::resource('companies', CompanyController::class);
Route::resource('companies.reviews', CompanyReviewController::class);
