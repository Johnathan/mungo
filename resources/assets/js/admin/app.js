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

const app = new Vue({
    data() {
        return {
            store: {
                currentUser: {},
                roles: [],
                permissions: []
            }
        };
    },

    mounted() {
        axios.get( '/api/me?include=roles.permissions,permissions' ).then( response => {
            this.$store.currentUser = response.data;

            this.$currentUser.set( this.$store.currentUser );
        });

        axios.get( '/api/admin/roles?include=permissions' ).then( response => {
            this.$store.roles = response.data;
        });

        axios.get( '/api/admin/permissions' ).then( response => {
            this.$store.permissions = response.data;
        });
    },

    router,
}).$mount( '#app' );
