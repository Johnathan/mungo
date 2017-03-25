{!! Form::model( $user,  [ 'route' => $user->id ? [ 'admin.users.update', $user->id ] : 'admin.users.store', 'method' => $user->id ? 'PUT' : 'POST' ] ) !!}
    <div class="columns">
        <div class="column is-8">
            {!! Form::textField( 'name', 'Name', null, null, true, $errors->first( 'name' ) ) !!}
            {!! Form::emailField( 'email', 'Email Address', null, null, true, $errors->first( 'email' ) ) !!}

            <div class="control is-grouped">
                <p class="control">
                    {!! Form::submit( $user->id ? 'Update User' : 'Create User', [ 'class' => 'button is-primary' ] ) !!}
                </p>
            </div>
        </div>

        <div class="column is-4">
            <nav class="panel">
                <p class="panel-heading">
                    Roles
                </p>

                @foreach( $roles as $role )
                    <a class="panel-block">
                        <p class="control">
                            <label class="checkbox">
                                {!! Form::checkbox( 'roles[]', 1, $user->roles->contains( $role ) ) !!}
                                {!! $role->name !!}
                            </label>
                        </p>
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
{!! Form::close() !!}
