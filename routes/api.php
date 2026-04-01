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
Route::get('/next', 'Api\ApiCallController@next');
Route::get('/call', 'Api\ApiCallController@call');
Route::get('/recall', 'Api\ApiCallController@recall');
Route::get('/get-counters', 'Api\ApiCallController@getCounters');
Route::get('/get-layanan', 'Api\ApiCallController@getDepartments');
Route::get('/get-antrian', 'Api\ApiCallController@getAntrian');
