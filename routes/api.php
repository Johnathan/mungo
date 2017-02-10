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

Route::name( 'api.admin.' )->prefix( 'admin' )->namespace( 'Api\Admin' )->group(function(){

    Route::middleware( [ 'role:admin', 'auth:api' ] )->group(function(){

        Route::get( '/roles', [ 'uses' => 'RolesController@index', 'as' => 'roles.index' ] );

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

    });

});



