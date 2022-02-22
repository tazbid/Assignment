<?php

//Route::get('/admin/user/update/{id}', [App\Http\Controllers\admin\dashboard\DashboardController::class, 'index']);

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth','role:super-admin']], function () {
    //view  dashboard route admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::view('admin/test','admin.test.test');
});
