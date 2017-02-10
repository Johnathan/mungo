<?php namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RolesController extends Controller {

    public function index()
    {
        return Role::get();
    }

}