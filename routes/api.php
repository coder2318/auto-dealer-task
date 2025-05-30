<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\V1\LeadController;
use App\Http\Controllers\V1\ManagerController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'lead'], function () {
    Route::post('create', [LeadController::class, 'createLead']);
});

Route::group(['middleware' => ['auth:sanctum', 'is-manager'], 'prefix' => 'manager'], function () {
    Route::get('list-leads', [ManagerController::class, 'index']);
    Route::post('get-lead/{id}', [ManagerController::class, 'getLead']);
    Route::patch('update/{id}', [ManagerController::class, 'update']);
});
