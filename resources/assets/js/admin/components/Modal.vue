<template>

    <div>
        <div class="modal" v-bind:class="active ? 'is-active' : ''">
            <div class="modal-background"></div>
            <div class="modal-card">
                <slot></slot>
            </div>
            <button class="modal-close" @click.prevent="closeModal()"></button>
        </div>
    </div>

</template>

<script type="text/javascript">
    export default {
        props: ['active'],

        methods: {
            closeModal() {
                this.active = false;
            }
        }
    }
</script>
