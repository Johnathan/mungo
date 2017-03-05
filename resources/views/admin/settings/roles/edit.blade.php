@extends( 'admin.layouts.master' )

@section( 'content' )
    <h1 class="title">Roles & Permissions</h1>
    <h2 class="subtitle">Edit {{ $role->name }} Role</h2>

    @include( 'admin.settings.roles.partials.form' )
@stop