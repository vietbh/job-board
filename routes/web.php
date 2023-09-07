<?php

use App\Models\JobApplication;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobController;

Route::get('', fn () => to_route('job.index'));
Route::resource('job',JobController::class)->only(['index','show']);

// Auth
Route::get('login', fn () => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);

Route::delete('logout', fn () => to_route('auth.destroy'))->name('logout');
Route::delete('auth',[AuthController::class,'destroy'])->name('auth.destroy');

Route::middleware('auth')->group( function (){
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);
        
    Route::resource('my-job-applications', JobApplicationController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);
    
    Route::middleware('employer')
        ->resource('my-job',MyJobController::class);
});