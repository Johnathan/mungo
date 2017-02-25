<?php

use Illuminate\Http\Request;

Route::middleware( [ 'auth:api' ] )->get( '/me', [ 'uses' => 'Api\UsersController@me', 'as' => 'api.users.me' ] );

Route::name( 'api.admin.' )->prefix( 'admin' )->namespace( 'Api\Admin' )->group(function(){

    Route::middleware( [ 'role:admin', 'auth:api' ] )->group(function(){

        Route::resource( 'roles', 'RolesController', [ 'only' => [ 'index', 'store' ] ] );
        Route::resource( 'permissions', 'PermissionsController', [ 'only' => [ 'index' ] ] );

    });

});



