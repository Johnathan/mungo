import Vue from 'vue';
import VueRouter from 'vue-router';
import VueStash from 'vue-stash';

import CurrentUser from './CurrentUser';

import Routes from './routes';

window.axios = require( 'axios' );

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-Token': document.querySelector('[name=_token]').getAttribute( 'content' )
};

Vue.use( VueRouter );
Vue.use( VueStash );
Vue.use( CurrentUser );

// Generic Components
import Multiselect from 'vue-multiselect'
Vue.component( 'multiselect', Multiselect );
Vue.component( 'alert', require( './components/Alert.vue' ) );
Vue.component( 'destroy-button', require( './components/DestroyButton.vue' ) );
Vue.component( 'nav-item', require( './components/NavItem.vue' ) );
Vue.component( 'modal', require( './components/Modal.vue' ) );


const router = new VueRouter({
    mode: 'history',
    routes: Routes
});

const guards = {
    'admin.settings.roles-and-permissions': {
        permissions: ['modify-roles']
    }
};


const app = new Vue({
    data() {
        return {
            store: {
                currentUser: null,
                roles: [],
                permissions: []
            }
        };
    },

    methods: {
        checkPermission( route, next ) {
            const guard = guards[route.name];
            let passed = false;

            if( typeof guard !== 'undefined' )
            {
                if( typeof guard.permissions !== 'undefined' )
                {
                    guard.permissions.forEach( permission => {
                        if( this.$currentUser.hasPermissionTo( permission ) && passed === false ) {
                            passed = true;
                        }
                    });
                }
            }
            else
            {
                passed = true;
            }

            if( passed )
            {
                // We have permission to view the current route

                // If next is set (coming from another page) then use it, otherwise we're loading the page for the
                // first time so just return true
                if( next ) next( true );
                return true;
            }
            else
            {
                // No permission :(

                // If we're not coming from another page in the system throw the user back to the dashboard
                if( next ) next( false );
                else this.$router.push({ name: 'admin.dashboard' });

            }
        }
    },

    mounted() {
        axios.get( '/api/me?include=roles.permissions,permissions' ).then( response => {

            // Put the current user into the store
            this.$store.currentUser = response.data;

            // Let `currentUser` know about the current user. obviously.
            this.$currentUser.set( this.$store.currentUser );

            // When we get the user for the first time make sure they have permission to view the route
            this.checkPermission( this.$route );
        });

        axios.get( '/api/admin/roles?include=permissions' ).then( response => {
            this.$store.roles = response.data;
        });

        axios.get( '/api/admin/permissions' ).then( response => {
            this.$store.permissions = response.data;
        });

        // On every page change make sure the user has permission to view the route
        this.$router.beforeEach( ( to, from, next ) => {
            this.checkPermission( to, next );
        });
    },

    router,
}).$mount( '#app' );
