<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;


Route::post('/login', [AuthController::class, 'login']);

// Scantam protected routes

Route::middleware('auth:sanctum')->group(function () {

	// Authentication 
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);


	// Projects
    Route::apiResource('projects', ProjectController::class);
	Route::get('projects/{project}/summary', [ProjectController::class, 'summary']);

	// Tasks (nested under projects)
    Route::apiResource('projects.tasks', TaskController::class);
});