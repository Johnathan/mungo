<template>
    <transition name="fade">
        <div class="notification" v-bind:class="alertType" v-if="visible">
            <button class="delete" @click="hideNotification()"></button>
            <slot></slot>
        </div>
    </transition>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .3s
    }

    .fade-enter, .fade-leave-to {
      opacity: 0
    }
</style>

<script type="text/javascript">

    export default {
        props: [ 'type' ],

        data() {
            return {
                visible: true
            };
        },

        mounted() {
            setTimeout( this.hideNotification, 5000 );
        },

        methods: {
            hideNotification() {
                this.visible = false;
            }
        },

        computed: {
            alertType() {
                if( ! this.type ) return;

                return 'is-' + this.type;
            }
        }
    }

</script>