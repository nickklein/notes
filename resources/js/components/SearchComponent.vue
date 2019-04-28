<template>
        <header class="search">
                <input type="text" name="search" id="search" v-on:change="signalChange"/>
                <tags-sidebar></tags-sidebar>
        </header>
</template>

<script>
    import {bus} from '../app';
    export default {
        name: 'search-sidebar',
        methods: {
            signalChange: function(test) {
                bus.$emit('filterSidebar', test.originalTarget.value);
            }
        }

    }
</script>
