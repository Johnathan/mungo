<?php

namespace Tests\Feature;

use App\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiRolesTest extends TestCase
{
    /**
     * Test to ensure roles are returned from the API.
     *
     * @return void
     */
    public function testRolesAreReturned()
    {
        $request = $this->actingAs( $this->adminUser, 'api' )
            ->get( 'api/admin/roles' );

        $request->assertJson([
            [
                'id' => 1,
                'name' => 'admin'
            ]
        ]);
    }

    /**
     * Test to ensure permissions are returned along with roles
     */
    public function testPermissionsAreReturnedWithRoles()
    {
        $request = $this->actingAs( $this->adminUser, 'api' )
            ->get( 'api/admin/roles?include=permissions' );

        $request->assertJson([
            [
                'permissions' => [
                    [
                        'name' => 'modify-roles'
                    ]
                ]
            ]
        ]);
    }

    /**
     * Test to ensure a permission can be added to a role
     */
    public function testPermissionCanBeAddedToRole()
    {
        $request = $this->actingAs( $this->adminUser, 'api' )
            ->patch( 'api/admin/roles/1?include=permissions', [
                'permissions' => [
                    $this->adminRole->id,
                    $this->testPermission->id
                ]
            ]);

        $request->assertExactJson([
            'id' => $this->adminRole->id,
            'name' => $this->adminRole->name,
            'permissions' => [
                [
                    'id' => 1,
                    'name' => 'modify-roles'
                ],
                [
                    'id' => $this->testPermission->id,
                    'name' => $this->testPermission->name
                ]
            ]
        ]);
    }

    /**
     *  Test to ensure a permission can be removed from a role
     */
    public function testPermissionCanBeRemovedFromRole()
    {
        // Add permission to role so we can remove it again
        $this->adminRole->givePermissionTo( $this->testPermission );

        $request = $this->actingAs( $this->adminUser, 'api' )
            ->patch( 'api/admin/roles/1?include=permissions', [
                'permissions' => [
                    $this->adminRole->id,
                ]
            ]);

        $request->assertExactJson([
            'id' => $this->adminRole->id,
            'name' => $this->adminRole->name,
            'permissions' => [
                [
                    'id' => 1,
                    'name' => 'modify-roles'
                ]
            ]
        ]);
    }
}
