<?php

use App\Http\Controllers\api\DiseaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::get('diseases', [DiseaseController::class, 'index'] );
    Route::get('diseases/{id}', [DiseaseController::class, 'show'] );
    Route::post('diseases', [DiseaseController::class, 'store'] );
    Route::put('diseases/{id}', [DiseaseController::class, 'update'] );
    Route::delete('diseases/{id}', [DiseaseController::class, 'destroy'] );
});
