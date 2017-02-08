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



// Admin Routes
Route::name( 'admin.' )->prefix( 'admin' )->namespace( 'Admin' )->group(function(){

    Route::resource( 'sessions', 'SessionsController' );

});