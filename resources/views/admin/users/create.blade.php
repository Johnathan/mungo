@extends( 'admin.layouts.master' )

@section( 'content' )
    <h1 class="title">Users</h1>
    <h2 class="subtitle">Add a user</h2>

    @include( 'admin.users.partials.form' )
@stop