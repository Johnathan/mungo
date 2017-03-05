<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use View;

class RolesController extends Controller {

    public function index()
    {
        $roles = Role::get();

        return View::make( 'admin.settings.roles.index', compact( 'roles' ) );
    }

    public function edit( $role )
    {
        $permissions = Permission::get();

        return View::make( 'admin.settings.roles.edit', compact( 'role', 'permissions' ) );
    }

    public function update( Request $request, Role $role )
    {
        // The only thing on a role we can update is the permissions
        $role->permissions()->sync( $request->permissions ?? [] );

        $request->session()->flash( 'success', 'Permissions have been updated' );

        return Redirect::route( 'admin.settings.roles.edit', $role->id );
    }

}