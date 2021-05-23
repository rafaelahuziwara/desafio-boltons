<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => []], function () {
    /**
     * api/v1/test
     */
    Route::get('/NFe/push', [\App\Http\Controllers\NFe\NFeController::class, 'pushNFes']);
    Route::get('/NFe/get/{accessKey}', [\App\Http\Controllers\NFe\NFeController::class, 'getTotalValueByAccessKey']);
});
