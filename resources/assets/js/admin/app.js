import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use( VueRouter );

// Generic Components
Vue.component( 'alert', require( './components/Alert.vue' ) );
Vue.component( 'destroy-button', require( './components/DestroyButton.vue' ) );

// Route Components
import Dashboard from './components/pages/Dashboard.vue';

const routes = [
    {
        path: '/admin',
        component: { template: '<router-view></router-view>' },
        children: [
            {
                path: 'dashboard',
                component: Dashboard
            }
        ]
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    router,
}).$mount( '#app' );
