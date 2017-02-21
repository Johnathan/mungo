<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UsersTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'roles',
        'permissions'
    ];

    /**
     * @param User $user
     * @return array
     */
    public function transform( User $user )
    {
        return [
            'id' => (int) $user->id,
            'name' => $user->name,
            'email_address' => $user->email
        ];
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    protected function includeRoles( User $user )
    {
        return $this->collection( $user->roles, new RolesTransformer );
    }

    /**
     * @param User $user
     * @return \League\Fractal\Resource\Collection
     */
    protected function includePermissions( User $user )
    {
        return $this->collection( $user->permissions, new PermissionsTransformer );
    }
}
