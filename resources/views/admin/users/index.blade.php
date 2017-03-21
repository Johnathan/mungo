@extends( 'admin.layouts.master' )

@section( 'content' )
    <h1 class="title">Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route( 'admin.users.edit', $user->id ) }}" class="button is-primary is-small">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $users->links() !!}
@stop