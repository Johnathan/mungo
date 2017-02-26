<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Facades\App;
use Laravel\Dusk\Browser;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminRolesAndPermissionsTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRolesAndPermissionsPageRenders()
    {
        $this->browse( function( Browser $browser ){
            $browser->loginAs( User::first() );

            $browser->visit( '/admin/settings/roles-and-permissions' );
            $browser->waitFor( 'header' );

            $browser->assertSeeIn( 'h1.title', 'Settings' );
            $browser->assertSeeIn( 'h2.subtitle', 'Roles & Permission' );
        });
    }

    public function testPermissionCanBeRemovedFromRole()
    {
        $this->browse( function( Browser $browser ){
            $adminRole = Role::whereName( 'admin' )->first();
            $permission = factory( Permission::class )->create();

            $permissionCount = count( $adminRole->permissions ) + 1;

            $adminRole->givePermissionto( $permission );

            $browser->loginAs( User::first() );

            $browser->visit( '/admin/settings/roles-and-permissions' );
            $browser->waitFor( 'header' );

            $browser->assertSee( $permission->name );

            $browser->click( '.tag.is-light:nth-child(' . $permissionCount . ') .delete' );

            $browser->pause( 1000 );

            // Reload the page to make sure it's gone
            $browser->visit( '/admin/settings/roles-and-permissions' );
            $browser->waitFor( 'header' );
            $browser->assertDontSee( $permission->name );
        });
    }

}
