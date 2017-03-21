<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSessionCreateRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class SessionsController extends Controller {

    /**
     * @return View
     */
    public function create()
    {
        return view()->make( 'admin.sessions.create' );
    }

    public function store( AdminSessionCreateRequest $request )
    {
        if( $user = User::authenticateAdministrator( $request->email, $request->password ) )
        {
            Auth::login( $user, $request->remember_me );

            return Redirect::to( 'admin/dashboard' );
       }
       else
       {
           $request->session()->flash( 'error', 'Your username or password were incorrect' );

           return Redirect::back();
       }
    }

    public function destroy()
    {
        Auth::logout();

        return Redirect::route( 'admin.sessions.create' );
    }

}