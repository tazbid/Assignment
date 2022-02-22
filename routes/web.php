<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
/------------------------------------------------------
/ Auth Routes
/-----------------------------------------
*/
Auth::routes();


/*
/------------------------------------------------------
/ Client Routes
/-----------------------------------------
*/

Route::get('/', function () {
    return Redirect::to('/admin/dashboard');
});



/*
/------------------------------------------------------
/ Admin Routes
/-----------------------------------------
*/

//dashboard
include "admin/dashboardRoute.php";


//pricing rules
include "admin/pricingRuleRoute.php";




/*
/------------------------------------------------------
/Admin Routes End
/-----------------------------------------
*/
