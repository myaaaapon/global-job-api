<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Application\Controllers\UserController;

// use App\Http\Controllers\Application\Controllers\JobController;

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

// ユーザー登録とログイン
Route::post('/user', [UserController::class, 'createUser']);
Route::post('/user/login', [UserController::class, 'login']);

// 認証が必要なルート
Route::middleware('auth:sanctum')->group(function () {

    // ユーザー関連のエンドポイント
    Route::get('/user', [UserController::class, 'getUser']);
    Route::put('/user', [UserController::class, 'updateUser']);
    Route::delete('/user', [UserController::class, 'deleteUser']);
    Route::post('/user/logout', [UserController::class, 'logout']);

    // ジョブ関連のエンドポイント
    // Route::get('/job', [JobController::class, 'getAllJobs']);
    // Route::get('/job/{id}', [JobController::class, 'getJobById']);
});
