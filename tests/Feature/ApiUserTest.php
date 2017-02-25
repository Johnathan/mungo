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
     * A basic test example.
     *
     * @return void
     */
    public function testAuthenticatedUserIsReturned()
    {
        $user = User::first();

        $response = $this->actingAs( $user, 'api' )
            ->get( 'api/me' );

        $response->assertStatus( 200 )
            ->assertExactJson([
                'id' => 1,
                'name' => 'Admin',
                'email_address' => 'admin@example.com'
            ]);
    }

    public function testAuthenticatedUserIsReturnedWithRolesAndPermissions()
    {
        $user = User::first();

        // Get the user with roles
        $response = $this->actingAs( $user, 'api' )
            ->get( 'api/me?include=roles' );

        $response->assertJson([
            'roles' => [
                [
                    'name' => 'admin'
                ]
            ]
        ]);

        // Do we get permissions as well as roles?
        $response = $this->actingAs( $user, 'api' )
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
