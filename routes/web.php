<?php

// Admin Routes
Route::name( 'admin.' )->prefix( 'admin' )->namespace( 'Admin' )->group(function(){

    Route::resource( 'sessions', 'SessionsController', [ 'only' => [ 'create', 'store' ] ] );
    Route::delete( 'sessions', [ 'uses' => 'SessionsController@destroy', 'as' => 'sessions.destroy' ] );

    Route::middleware( [ 'role:admin' ] )->group(function(){

        Route::get( '/dashboard', [
            'uses' => 'DashboardController@index',
            'as' => 'admin.dashboard.index'
        ]);

        Route::name( 'settings.' )->prefix( 'settings' )->group(function(){
            Route::resource( 'roles', 'RolesController' );
        });
    });

});