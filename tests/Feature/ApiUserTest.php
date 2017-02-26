<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiUserTest extends TestCase
{
    /**
     * Test to ensure authenticated user is returned
     *
     * @return void
     */
    public function testAuthenticatedUserIsReturned()
    {
        $response = $this->actingAs( $this->adminUser, 'api' )
            ->get( 'api/me' );

        $response->assertStatus( 200 )
            ->assertExactJson([
                'id' => $this->adminUser->id,
                'name' => $this->adminUser->name,
                'email_address' => $this->adminUser->email
            ]);
    }

    /**
     * Test to ensure user can be returned along with roles and permissions
     */
    public function testAuthenticatedUserIsReturnedWithRolesAndPermissions()
    {
        // Get the user with roles
        $response = $this->actingAs( $this->adminUser, 'api' )
            ->get( 'api/me?include=roles' );

        $response->assertJson([
            'roles' => [
                [
                    'name' => 'admin'
                ]
            ]
        ]);

        // Do we get permissions as well as roles?
        $response = $this->actingAs( $this->adminUser, 'api' )
            ->get( 'api/me?include=roles.permissions' );

        $response->assertJson([
            'roles' => [
                [
                    'permissions' => [
                        [
                            'name' => 'modify-roles'
                        ]
                    ]
                ]
            ]
        ]);
    }
}
