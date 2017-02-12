<?php namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Transformers\PermissionsTransformer;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller {

    public function index()
    {
        $permissions = Permission::get();

        return $this->respondWithCollection( $permissions, new PermissionsTransformer );
    }

}