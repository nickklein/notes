<template>
   <a href="#" id="add-more" v-on:click="addNote">+</a>
</template>
<script>

import {bus} from '../app';

export default {
	name: 'create-note',
    methods: {
        addNote: function() {
            this.$http.post('/api/notes/create', {_token: window.Laravel['csrfToken']});
            bus.$emit('filterSidebar', '');
        }
    }
};
</script>