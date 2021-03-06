@extends( 'admin.layouts.master' )

@section( 'content' )
    <h1 class="title">Users</h1>
    
    {!! Form::open( [ 'route' => 'admin.users.index', 'method' => 'GET' ] ) !!}
        {!! Form::searchField() !!}
    {!! Form::close() !!}

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
                        @if( Auth::user()->can( 'manage-users' ) )
                            <a href="{{ route( 'admin.users.edit', $user->id ) }}" class="button is-primary is-small">Edit</a>
                            <destroy-button href="{{ route( 'admin.users.destroy', $user->id ) }}" class="button is-danger is-small">Delete User</destroy-button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $users->links( 'admin.partials.pagination' ) !!}
@stop