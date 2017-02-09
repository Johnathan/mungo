<template>
    <a href="#" v-bind:class="buttonClass" @click.prevent="submitForm">
        <slot></slot>
        <form v-bind:action="href" method="POST" ref="form" style="display:none;">
            <input type="hidden" name="_method" value="DELETE" />
            <input type="hidden" name="_token" v-bind:value="csrfToken" />
        </form>
    </a>
</template>

<script>
    export default {
        props: [ 'class', 'href' ],

        data() {
            return {
                csrfToken: document.querySelector('[name=_token]').getAttribute( 'content' )
            }
        },

        computed: {
            buttonClass() {
                return this.class;
            }
        },

        methods: {
            submitForm() {
                this.$refs.form.submit();
            }
        }
    }
</script>