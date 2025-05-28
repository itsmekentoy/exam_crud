<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\DashboardMainController;

// create group of routes for credential controller
Route::controller(CredentialController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('/loginsubmit', 'login')->name('submitLogin');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/registersubmit', 'register')->name('submitRegister');
});
Route::controller(DashboardMainController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::post('/add-sales', 'addSalesData')->name('addSalesData');
    Route::DELETE('deleteSalesData/{id}', 'deleteSalesData')->name('deleteSalesData');
    Route::post('/update-sales', 'updateSalesData')->name('updateSalesData');
});