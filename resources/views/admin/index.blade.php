<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mungo</title>

        <link rel="stylesheet" href="{{ mix( 'css/admin/app.css' ) }}">

        <meta name="_token" content="{{ csrf_token() }}"/>
    </head>

    <body>
        <div id="app">
            <header>
                <nav class="nav has-shadow">
                    <div class="container">
                        <div class="nav-left">
                            <a class="nav-item">
                                <img src="/img/admin/mungo-logo.png" alt="Mungo logo">
                            </a>
                            <a class="nav-item is-tab is-hidden-mobile is-active">Dashboard</a>
                        </div>
                        <span class="nav-toggle">
                          <span></span>
                          <span></span>
                          <span></span>
                        </span>
                        <div class="nav-right nav-menu">
                            <a class="nav-item is-tab is-hidden-tablet is-active">Home</a>
                            <a class="nav-item is-tab is-hidden-tablet">Features</a>
                            <a class="nav-item is-tab is-hidden-tablet">Pricing</a>
                            <a class="nav-item is-tab is-hidden-tablet">About</a>
                            <a class="nav-item is-tab">
                                Profile
                            </a>
                            <destroy-button class="nav-item is-tab" href="{{ route( 'admin.sessions.destroy' ) }}">Sign out</destroy-button>
                        </div>
                    </div>
                </nav>
            </header>

            <section class="section">
                <div class="container">
                    <div class="columns">
                        <div class="column is-one-quarter">
                            <aside class="menu">
                                <p class="menu-label">
                                    Administration
                                </p>
                                <ul class="menu-list">
                                    <li><a>Team Settings</a></li>
                                    <li>
                                        <a class="is-active">Manage Your Team</a>
                                        <ul>
                                            <li><a>Members</a></li>
                                            <li><a>Plugins</a></li>
                                            <li><a>Add a member</a></li>
                                        </ul>
                                    </li>
                                    <li><a>Invitations</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="column">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <script src="{{ mix( 'js/admin/app.js' ) }}"></script>
    </body>
</html>
