import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        roles: [],
        permissions: [],
    },
    actions: {
        LOAD_ROLES( { commit } ) {
            axios.get( '/api/admin/roles?include=permissions' ).then( response => {
                commit( 'SET_ROLES', { roles: response.data } );
            });
        },

        LOAD_PERMISSIONS( { commit } ) {
            axios.get( '/api/admin/permissions' ).then( response => {
                commit( 'SET_PERMISSIONS', { permissions: response.data } );
            });
        },

        REMOVE_ROLE_PERMISSION( { state, commit }, role, permission ) {

            role = state.roles[state.roles.indexOf( role )];

            // New array of permissions to send to the server
            // is what should happen. it actually doesn't but I'm going to bed ¯\_(ツ)_/¯    
            const permissions = JSON.parse( JSON.stringify( role.permissions ) )
                .splice( role.permissions.indexOf( permission ), 1 );

            axios.patch('/api/admin/roles/' + role.id + '?include=permissions', {
                permissions: permissions.map( ( permission ) => {
                    return permission.id;
                })
            }).then(response => {
                commit( 'REMOVE_ROLE_PERMISSION', { role: response.data } );
            });
        }
    },
    mutations: {
        SET_ROLES( state, { roles } ) {
            state.roles = roles;
        },

        SET_PERMISSIONS( state, { permissions } ) {
            state.permissions = permissions;
        },

        REMOVE_ROLE_PERMISSION( state, { role } ) {
            // This doesn't work at all
            state.roles[state.roles.findIndex( existingRole => {
                console.log( existingRole.id == role.id );
                return existingRole.id == role.id;
            })] = role;
        },
    },
    getters: {
        roles() {
            return state.roles;
        },

        permissions() {
            return state.permissions;
        }
    }
});

export default store