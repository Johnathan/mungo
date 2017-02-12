<template>

    <div>
        <header class="modal-card-head">
            <p class="modal-card-title">Modify {{ role.name }} Permissions</p>
            <button class="delete" @click.prevent="cancelModification()"></button>
        </header>
        <section class="modal-card-body">
            <div class="modify-role-select-container">
                <multiselect
                        v-model="role.permissions"
                        :options="permissions"
                        :multiple="true"
                        placeholder="Choose Permissions"
                        label="name"
                        track-by="id">
                </multiselect>
            </div>
        </section>
        <footer class="modal-card-foot">
            <a class="button is-success" @click.pervent="updatePermissions()">Save changes</a>
            <a class="button" @click.prevent="cancelModification()">Cancel</a>
        </footer>
    </div>

</template>

<script type="text/javascript">
    export default {
        props: ['role', 'permissions'],

        data() {
            return {
                originalPermissions: null
            };
        },

        mounted() {
            this.originalPermissions = JSON.parse( JSON.stringify( this.role.permissions ) );
        },

        methods: {
            updatePermissions() {
                const role = this.role;

                axios.patch('/api/admin/roles/' + role.id + '?include=permissions', {
                    permissions: role.permissions.map( ( permission ) => {
                        return permission.id;
                    })
                }).then(response => {
                    this.$emit( 'cancel' );
                });
            },

            cancelModification() {
                this.role.permissions = this.originalPermissions;

                this.$emit( 'cancel' );
            }
        },

        computed: {
            permissionsForSelect() {
                return this.permissions.map( ( permission ) => {
                    return {
                        label: permission.name,
                        value: permission.id
                    };
                });
            }
        }
    }
</script>
