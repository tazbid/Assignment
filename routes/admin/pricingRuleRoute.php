<?php

use App\Http\Controllers\PricingRule\PricingRuleController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:super-admin']], function () {

    //view all pricing rules
    Route::get('/admin/pricing/rules', [PricingRuleController::class, 'getAllPricingRules']);
    //pricing rules details
    Route::get('/admin/pricing/rule/details/{id}', [PricingRuleController::class, 'getpPicingRuleDetails']);
    //pricing rules edit view
    Route::get('/admin/pricing/rule/edit/{id}', [PricingRuleController::class, 'pricingRuleEditView']);

    //pricing rules create
    Route::get('admin/pricing/rule/create', [PricingRuleController::class, 'pricingRuleInsertView']);

    //pricing rules details view

    //pricing rules datatable route
    Route::post('/admin/pricing/rules', [PricingRuleController::class, 'getpricingRuleDataTableAjax']);
    //add pricing rules
    Route::post('/admin/pricing/rule/insert', [PricingRuleController::class, 'pricingRuleInsertAjax']);
    //update pricing rules
    Route::post('/admin/pricing/rule/update', [PricingRuleController::class, 'pricingRuleUpdateAjax']);
    //delete pricing rules
    Route::post('/admin/pricing/rule/delete', [PricingRuleController::class, 'pricingRuleDeleteAjax']);
});
