<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/services/list', 'ServiceController@list')->name('service.list')->middleware('jwt');

Route::post('/service-items', 'ServiceController@listItem')->name('service.list.item')->middleware('jwt');

Route::get('/service-items/list-amount', 'ServiceController@listAmount')->name('service.list.amount')->middleware('jwt');

Route::post('/buy/card-game', 'CardGameController@buy')->name('buy.card-game')->middleware('jwt');

Route::get('/list-service-baokim', 'BaokimController@listService')->name('baokim.list.service');

Route::post('/buy/service', 'BaokimController@buyService')->name('buy.service');
