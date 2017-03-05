{!! Form::model( $role, [
    'route' => $role->id ? [ 'admin.settings.roles.update', $role->id ] : 'admin.settings.roles.store',
    'method' => $role->id ? 'PUT' : 'POST'
])!!}

    <label for="permissions">Permissions</label>
    <p class="control">
        <multiselect
                name="permissions[]"
                :value="{{ json_encode( $role->permissions->toArray() ) }}"
                :options="{{ json_encode( $permissions->toArray() ) }}">
        </multiselect>
    </p>

    <div class="control is-grouped">
        <p class="control">
            {!! Form::submit( 'Save', [ 'class' => 'button is-primary' ] ) !!}
        </p>
    </div>

{!! Form::close() !!}