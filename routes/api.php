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

Route::get('/estrutura','LiketController@getEstruturaGraficos');
Route::get('/xml/anos','LiketController@getAnosXml');
Route::get('/xml/meses/{ano}','LiketController@getMesesXml');
Route::get('/xml/dias/{ano}/{mes}','LiketController@getDiasXml');
Route::get('/xml/saidas/{ano}/{mes}/{dia}','LiketController@obterSaidas');
