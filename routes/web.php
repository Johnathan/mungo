<?php

// Admin Routes
Route::name( 'admin.' )->prefix( 'admin' )->namespace( 'Admin' )->group(function(){

    Route::resource( 'sessions', 'SessionsController', [ 'only' => [ 'create', 'store' ] ] );
    Route::delete( 'sessions', [ 'uses' => 'SessionsController@destroy', 'as' => 'sessions.destroy' ] );

    Route::middleware( [ 'role:admin' ] )->group(function(){

        Route::get( '/', function(){
            return Redirect::to( 'admin/dashboard' );
        });

        Route::get('{path}', function () {
            return view( 'admin.index' );
        })->where( 'path', '([A-z\d-\/_.]+)?' );

    });

});