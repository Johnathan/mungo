<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUsersCreateRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class UsersController extends Controller {

    public function index()
    {
        if( Input::has( 'query' ) )
            $users = User::search( Input::get( 'query' ) );
        else
            $users = new User;

        $users = $users->paginate( 15 );


        return view()->make( 'admin.users.index', compact( 'users' ) );
    }

    public function create()
    {
        $user = new User;

        return view()->make( 'admin.users.create', compact( 'user' ) );
    }

    public function store( AdminUsersCreateRequest $request )
    {
        $user = new User( $request->all() );

        // We're creating a user and don't have a password so we'll just set something random
        $user->password = Str::random();

        $user->save();

        $request->session()->flash( 'success', 'User has been created' );

        return redirect()->route( 'admin.users.index' );
    }

    public function edit( User $user )
    {
        return view()->make( 'admin.users.edit', compact( 'user' ) );
    }

    public function update( AdminUsersUpdateRequest $request, User $user )
    {
        $user->update( $request->all() );

        $request->session()->flash( 'success', 'User has been updated' );

        return redirect()->route( 'admin.users.index' );
    }

}