<?php

use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\VakancyController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
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

// Route::apiResource('/vakancies', 'AuthController');
// Route::resource('/vakancies', AuthController::class)->only([
//     'index', 'show', 'store', 'update', 'destroy'
// ]);
// Route::apiResource('vakancies', VakancyController::class)->middleware('auth:sanctum');
// Route::apiResource('resumes', ResumeController::class)->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::get('vakancies', [ApiController::class, 'getVakancies'])->middleware('auth:sanctum');
Route::get('resumes', [ApiController::class, 'getResumes'])->middleware('auth:sanctum');
