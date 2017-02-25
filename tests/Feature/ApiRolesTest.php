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
     * A basic test example.
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
}
