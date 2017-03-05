<template>
    <div>
        <multiselect-base
                v-model="selected"
                :multiple="true"
                :options="options"
                label="name">
        </multiselect-base>

        <select :name="name" multiple v-show="false">
            <option v-for="item in selected" selected :value="item.id">{{item.name}}</option>
        </select>
    </div>
</template>

<script type="text/javascript">
    export default{

        props: ['name', 'value', 'options'],

        data() {
            return {
                selected: []
            };
        },

        mounted() {
            this.selected = this.value;
        }
    };
</script>