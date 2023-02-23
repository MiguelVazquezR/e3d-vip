<?php

use App\Http\Controllers\Api\QuotationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('quotations', QuotationController::class)->names('api.v1.quotations');
