<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller {

    public function index()
    {
        $users = User::paginate( 10 );

        return view()->make( 'admin.users.index', compact( 'users' ) );
    }

}