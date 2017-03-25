<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use View;

class RolesController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $roles = Role::get();

        return view()->make('admin.settings.roles.index', compact('roles'));
    }

    /**
     * @param Role $role
     * @return mixed
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();

        return view()->make('admin.settings.roles.edit', compact('role', 'permissions'));
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return mixed
     */
    public function update(Request $request, Role $role)
    {
        // The only thing on a role we can update is the permissions
        $role->permissions()->sync($request->permissions ?? []);

        $request->session()->flash('success', 'Permissions have been updated');

        return redirect()->route('admin.settings.roles.edit', $role->id);
    }
}
