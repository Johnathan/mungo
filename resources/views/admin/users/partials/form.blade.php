{!! Form::model( $user,  [ 'route' => $user->id ? [ 'admin.users.update', $user->id ] : 'admin.users.store', 'method' => $user->id ? 'PUT' : 'POST' ] ) !!}
    {!! Form::textField( 'name', 'Name', null, null, true, $errors->first( 'name' ) ) !!}
    {!! Form::emailField( 'email', 'Email Address', null, null, true, $errors->first( 'email' ) ) !!}

    <div class="control is-grouped">
        <p class="control">
            {!! Form::submit( $user->id ? 'Update User' : 'Create User', [ 'class' => 'button is-primary' ] ) !!}
        </p>
    </div>
{!! Form::close() !!}