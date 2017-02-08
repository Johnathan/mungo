<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mungo &mdash; @yield( 'title' )</title>

        <link rel="stylesheet" href="{{ mix( 'css/admin/app.css' ) }}">

    </head>
    <body>
        <div id="app">
            <section class="hero is-dark is-fullheight">
                <div class="hero-body">
                    <div class="container">
                        <div class="columns">
                            <div class="column is-half">
                                <h1 class="title">
                                    Welcome to Mungo!
                                </h1>
                                <h2 class="subtitle">
                                    @yield( 'title' )
                                </h2>
                            </div>

                            <div class="column is-half">
                                @yield( 'content' )
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script src="{{ mix( 'js/admin/app.js' ) }}"></script>
    </body>
</html>
