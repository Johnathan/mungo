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
    <template v-if="$store.currentUser">
        <header>
            <nav class="nav has-shadow">
                <div class="container">
                    <div class="nav-left">
                        <a class="nav-item">
                            <img src="/img/admin/mungo-logo.png" alt="Mungo logo">
                        </a>
                        <router-link class="nav-item is-tab is-hidden-mobile"
                                     to="/admin/dashboard"
                                     active-class="is-active">
                            Dashboard
                        </router-link>
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
                                <nav-item href="/admin/users">Users</nav-item>
                                <nav-item href="/admin/settings">
                                    System Settings
                                    <nav-item slot="sub" href="/admin/settings/roles-and-permissions" v-if="$currentUser.hasPermissionTo( 'modify-roles' )">
                                        Roles &amp; Permissions
                                    </nav-item>
                                    <nav-item slot="sub" href="/admin/settings/localisation">
                                        Localisation
                                    </nav-item>
                                </nav-item>
                            </ul>
                        </aside>
                    </div>
                    <div class="column">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </section>
    </template>
</div>

<script src="{{ mix( 'js/admin/app.js' ) }}"></script>
</body>
</html>
