<template>
    <li>
        <a :href="href" :class="isActive ? 'is-active' : ''">
            <slot></slot>
        </a>
        <ul v-if="$slots.sub">
            <slot name="sub"></slot>
        </ul>
    </li>
</template>

<script>
    export default {
        props: [ 'href', 'isActive' ]
    }
</script>