<template>
    <div>
        <h2 class="subtitle">Roles &amp; Permissions</h2>

        <modal :active="modifyRole">
            <modify-role v-if="modifyRole" :role="modifyRole" :permissions="permissions" @cancel="closeRoleModal()"></modify-role>
        </modal>

        <table class="table" v-if="roles">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles">
                    <td>{{ role.name }}</td>
                    <td>
                        <span class="tag is-light" v-for="permission in role.permissions">
                            {{ permission.name }}
                            <button class="delete is-small" @click.prevent="removePermission( role, permission )"></button>
                        </span>
                        <span class="tag is-success" @click.prevent="openRoleModal( role )">
                            Add Permission
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script type="text/javascript">
    import { mapState } from 'vuex';
    export default {

        data() {
            return {
                modifyRole: null,
            };
        },

        mounted() {
            this.$store.dispatch( 'LOAD_ROLES' );
            this.$store.dispatch( 'LOAD_PERMISSIONS' );
        },

        methods: {
            openRoleModal( role ) {
                this.modifyRole = role;
            },

            closeRoleModal() {
                this.modifyRole = null;
            },

            removePermission( role, permission ) {

                this.$store.dispatch( 'REMOVE_ROLE_PERMISSION', role, permission );
            }
        },

        computed: mapState( [ 'roles', 'permissions' ] ),

        components: {
            'modify-role': require( './ModifyRole.vue' )
        }
    }
</script>