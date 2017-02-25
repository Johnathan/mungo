<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiPermissionTest extends TestCase
{
    /**
     * Test to ensure permissions are returned from API
     *
     * @return void
     */
    public function testPermissionsAreReturned()
    {
        $request = $this->actingAs( $this->adminUser, 'api' )
            ->get( 'api/admin/permissions' );

        $request->assertJson([
            [
                'id' => 1,
                'name' => 'modify-roles'
            ]
        ]);
    }
}
