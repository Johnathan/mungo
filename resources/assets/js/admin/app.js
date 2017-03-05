import Vue from 'vue';

window.axios = require( 'axios' );

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-Token': document.querySelector('[name=_token]').getAttribute( 'content' )
};

// Generic Components
import MultiselectBase from 'vue-multiselect'
Vue.component( 'multiselect-base', MultiselectBase );
Vue.component( 'multiselect', require( './components/MultiSelect.vue' ) );

Vue.component( 'alert', require( './components/Alert.vue' ) );
Vue.component( 'destroy-button', require( './components/DestroyButton.vue' ) );
Vue.component( 'nav-item', require( './components/NavItem.vue' ) );
Vue.component( 'modal', require( './components/Modal.vue' ) );

const app = new Vue({
    el: '#app',
    data() {
        return {
        };
    },
});
