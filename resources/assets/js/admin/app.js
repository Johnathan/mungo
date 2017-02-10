import Vue from 'vue';
import VueRouter from 'vue-router';

import Routes from './routes';

window.axios = require( 'axios' );

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-Token': document.querySelector('[name=_token]').getAttribute( 'content' )
};

Vue.use( VueRouter );

// Generic Components
Vue.component( 'alert', require( './components/Alert.vue' ) );
Vue.component( 'destroy-button', require( './components/DestroyButton.vue' ) );
Vue.component( 'nav-item', require( './components/NavItem.vue' ) );


const router = new VueRouter({
    mode: 'history',
    routes: Routes
});

const app = new Vue({
    router,
}).$mount( '#app' );
