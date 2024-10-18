<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployerController;
use App\Http\Controllers\Api\JobApplicationController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\MyJobApplicationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



Route::prefix("v1")->group(function () {

    /* Authentication */
    Route::prefix("auth")->as("auth.")->group( function() {
        Route::post('login', [AuthController::class, "login"])->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
        Route::post('signup', [AuthController::class, 'signup'])->name('signup');
    }
    );

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('jobs', JobController::class);
        
        Route::apiResource('job.application', JobApplicationController::class)->only([ 'store']);

        Route::apiResource('my-job-application', MyJobApplicationsController::class);

        Route::get('postjobs', [EmployerController::class, 'allJobApplication']);

        Route::get('postjobs/{postjobs}', [EmployerController::class, 'jobApplicate']);
    });

});