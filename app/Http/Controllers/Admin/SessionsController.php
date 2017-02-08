<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSessionCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SessionsController extends Controller {

    public function create()
    {
        return View::make( 'admin.sessions.create' );
    }

    public function store( AdminSessionCreateRequest $request )
    {
        dd( $request->all() );
    }

}