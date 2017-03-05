<ul class="menu-list">
    @foreach( Config::get( 'admin.nav' ) as $item )
        <nav-item
            :is-active="{{ Route::currentRouteName() == $item['route'] ? 'true' : 'false' }}"
            href="{{ $item['route'] ? route( $item['route'] ) : '/#' }}"
        >
            {{ $item['title'] }}
            @if( ! empty( $item['children'] ) )
                @include( 'admin.layouts.partials.nav-children', [ 'items' => $item['children'] ] )
            @endif
        </nav-item>
    @endforeach
</ul>