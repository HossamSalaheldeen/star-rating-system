<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadPurchaseRequestController;
use App\Http\Controllers\SubLeadController;
use App\Http\Controllers\SubLeadPurchaseRequestController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/timeline', function () {
    return view('timeline');
});

Route::resource('vendors', VendorController::class);
Route::resource('leads', LeadController::class);
Route::resource('leads.sub-leads', SubLeadController::class);
Route::resource('leads.purchase-requests', LeadPurchaseRequestController::class);
Route::resource('leads.sub-leads.purchase-requests', SubLeadPurchaseRequestController::class);
