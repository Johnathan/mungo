@extends( 'admin.layouts.master' )

@section( 'content' )
    <h1 class="title">Users</h1>
    <h2 class="subtitle">Edit user &mdash; {{ $user->name }}</h2>

    @include( 'admin.users.partials.form' )
@stop