@extends( 'admin.layouts.unauthenticated' )

@section( 'title', 'Sign In' )

@section( 'content' )
    {!! Form::open( [ 'method' => 'POST', 'route' => 'admin.sessions.store' ] ) !!}

        {!! Form::emailField( 'email', 'Email Address', null, null, false, $errors->first( 'email' ) ) !!}
        {!! Form::passwordField( 'password', 'Password', null, null, false, $errors->first( 'password' ) ) !!}

        <p class="control">
            <label class="checkbox">
                {!! Form::checkbox( 'remember_me' ) !!}
                Remember me
            </label>
        </p>

        <div class="control is-grouped">
            <p class="control">
                {!! Form::submit( 'Sign In', [ 'class' => 'button is-primary' ] ) !!}
            </p>
            <p class="control">
                <button class="button is-link">Forgotten your password?</button>
            </p>
        </div>

    {!! Form::close() !!}
@stop
