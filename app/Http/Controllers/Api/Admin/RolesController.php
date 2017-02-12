<?php namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ApiRoleUpdateRequest;
use App\Transformers\RolesTransformer;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller {

    public function index()
    {
        $roles = Role::get();

        return $this->respondWithCollection( $roles, new RolesTransformer );
    }

    public function update( ApiRoleUpdateRequest $request, Role $role )
    {
        if( Input::has( 'permissions' ) ) $role->syncPermissions( array_map(function( $permission ){
            return Permission::find( $permission );
        }, Input::get( 'permissions' )) );

        return $this->respondWithItem( $role, new RolesTransformer );
    }

}