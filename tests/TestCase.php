<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected $adminUser;
    protected $testPermission;
    protected $adminRole;

    public function setUp()
    {
        parent::setUp();

        $this->adminRole = Role::whereName( 'admin' )->first();

        $this->testPermission = factory( Permission::class )->create();

        $this->adminUser = factory( User::class )->create();
        $this->adminUser->assignRole( $this->adminRole );
    }
}
