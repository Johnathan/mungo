<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminLoginTest extends DuskTestCase
{
    /**
     * Test login page is displayed at /admin
     */
    public function testLoginPageIsRendered()
    {
        $this->browse(function ( Browser $browser) {
            $browser->visit('/admin')
                    ->assertSee('Sign In');
        });
    }

    /**
     * Test blank form submission displays validation errors
     */
    public function testSubmittingBlankFormDisplaysValidationErrors()
    {
        $this->browse(function( Browser $browser ){
            $browser->visit( '/admin' );
            $browser->click( '.button.is-primary' );
            $browser->assertSee( 'The email field is required.' );
            $browser->assertSee( 'The password field is required.' );
        });
    }

    /**
     * Test user can't login  with invalid credentials
     */
    public function testInvalidCredentialsCantLogin()
    {
        $this->browse( function( Browser $browser ){
            $browser->visit( '/admin' );
            $browser->type( 'email', 'admin@example.com' );
            $browser->type( 'password', 'wrongpassword' );
            $browser->click( '.button.is-primary' );
            $browser->assertSee( 'Your username or password were incorrect' );
        });
    }

    /**
     * Test user with correct credentials but without an admin role cannot login
     */
    public function testCorrectCredentialsButNoAdminRole()
    {
        $this->browse( function( Browser $browser ) {
            $browser->visit( '/admin' );
            $browser->type( 'email', 'non-admin@example.com' );
            $browser->type( 'password', 'password' );
            $browser->click( '.button.is-primary' );
            $browser->assertSee( 'Your username or password were incorrect' );
        });
    }

    /**
     * Test user can login with valid credentials
     */
    public function testCorrectCredentialsLogin()
    {
        $this->browse( function( Browser $browser ){
            $browser->visit( '/admin' );
            $browser->type( 'email', 'admin@example.com' );
            $browser->type( 'password', 'password' );
            $browser->click( '.button.is-primary' );
            $browser->waitFor( 'header' );
            $browser->assertSee( 'Dashboard' );
        });
    }

    /**
     * Test user can logout
     */
    public function testUserCanLogout()
    {
        $this->browse( function( Browser $browser ){
            $browser->loginAs( 1 );

            $browser->visit( '/admin' );
            $browser->waitFor( 'header' );

            $browser->assertSee( 'Sign out' );
            $browser->click( '.nav-right a:last-of-type' );
            $browser->assertSee( 'Sign In' );
        });
    }
}
