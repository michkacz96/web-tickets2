<?php

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

Route::prefix('v1')->group(function (){
    Route::controller(App\Http\Controllers\Api\V1\CustomerController::class)->group(function (){
        Route::get('customers', 'index');
        Route::get('customers/{customer}', 'show');
        Route::post('customers', 'store');
        Route::match(['put', 'patch'], 'customers/{customer}', 'update');
        Route::delete('customers/{customer}', 'destroy');
    });
    Route::controller(App\Http\Controllers\Api\V1\CustomerEmailController::class)->group(function (){
        Route::get('customer-emails', 'index');
        Route::get('customer-emails/{customer_email}', 'show');
        Route::post('customer-emails', 'store');
        Route::match(['put', 'patch'], 'customer-emails/{customer_email}', 'update');
        Route::delete('customer-emails/{customer_email}', 'destroy');
    });
});
