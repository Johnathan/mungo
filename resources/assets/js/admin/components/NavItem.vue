<template>

    <li>
        <router-link :to="{path: href}" active-class="is-active"><slot></slot></router-link>
        <ul v-if="$slots.sub">
            <slot name="sub"></slot>
        </ul>
    </li>

</template>

<script>
    export default {
        props: [ 'href' ]
    }
</script>