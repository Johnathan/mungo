@foreach( $items as $item )
    <nav-item
        slot="sub"
        :is-active="{{ Route::currentRouteName() == $item['route'] ? 'true' : 'false' }}"
        href="{{ $item['route'] ? route( $item['route'] ) : '#' }}"
    >
        {{ $item['title'] }}
        @if( ! empty( $item['children'] ) )
            @include( 'admin.layouts.partials.nav-children', [ 'items' => $item['children'] ] )
        @endif
    </nav-item>
@endforeach