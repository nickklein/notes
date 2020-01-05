<template>
        <header class="search">
                <input type="text" name="search" id="search" v-on:keyup="signalChange"/>
        </header>
</template>

<script>
    import {bus} from '../app';
    export default {
        name: 'notes-sidebar-search',
        methods: {
            signalChange: function(test) {
                // Reduce the amount of requests to the server a little bit, without hopefully effecting UX
                if (test.originalTarget.value.length > 2 || test.originalTarget.value.length == 0) {
                    bus.$emit('filterSidebar', test.originalTarget.value);
                }
            }
        }

    }
</script>
