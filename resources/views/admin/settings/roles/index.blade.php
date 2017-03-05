@extends( 'admin.layouts.master' )

@section( 'content' )
    <h1 class="title">Settings</h1>
    <h2 class="subtitle">Roles & Permission</h2>

    <table class="table">
        <thead>
        <tr>
            <th>Role</th>
            <th>Permissions</th>
            <th>Actions</th>
        </tr>
        </thead>
            @foreach( $roles as $role )
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach( $role->permissions as $permission )
                        <span class="tag is-light">
                            {{ $permission->name }}
                        </span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route( 'admin.settings.roles.edit', $role->id ) }}" class="button is-light is-small">Edit</a>
                </td>
            </tr>
            @endforeach
        <tbody>
        </tbody>
    </table>
@stop