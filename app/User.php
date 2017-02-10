<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute( string $password )
    {
        return $this->attributes['password'] = Hash::make( $password );
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|bool
     */
    public static function authenticateAdministrator( string $email, string $password )
    {
        $user = Role::whereName( 'admin' )->first()->users()->whereEmail( $email )->first();

        if( $user && Hash::check( $password, $user->password ) )
        {
            return $user;
        }

        return false;
    }
}
