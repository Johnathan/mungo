<?php

// Admin Routes
Route::name( 'admin.' )->prefix( 'admin' )->namespace( 'Admin' )->group(function(){

    Route::get( '/', function(){
        return redirect()->route( 'admin.dashboard.index' );
    });

    Route::resource( 'sessions', 'SessionsController', [ 'only' => [ 'create', 'store' ] ] );
    Route::delete( 'sessions', [ 'uses' => 'SessionsController@destroy', 'as' => 'sessions.destroy' ] );

    Route::middleware( [ 'role:admin' ] )->group(function(){

        Route::get( '/dashboard', [
            'uses' => 'DashboardController@index',
            'as' => 'dashboard.index'
        ]);

        Route::resource( 'users', 'UsersController' );

        Route::name( 'settings.' )->prefix( 'settings' )->group(function(){
            Route::resource( 'roles', 'RolesController', [
                'only' => [
                    'index',
                    'edit',
                    'update'
                ]
            ]);
        });
    });

});
