<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\Permission\Contracts\Permission;

class PermissionsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Permission $permission
     * @return array
     */
    public function transform( Permission $permission )
    {
        return [
            'id' => (int) $permission->id,
            'name' => $permission->name
        ];
    }
}
