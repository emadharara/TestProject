<?php

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
Route::get('home', 'accountCon@allAccount');
Route::get('getSup', 'accountCon@getSup');
Route::get('getData', 'accountCon@getData');
Route::get('getData2', 'accountCon@getData2');

Route::get('test', function () {
    return view('test');
});