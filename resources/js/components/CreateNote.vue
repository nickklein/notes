<template>
   <a href="#" id="add-more" v-on:click="addNote">+</a>
</template>
<script>

import {bus} from '../app';

export default {
	name: 'create-note',
    methods: {
        addNote: function() {
            this.$http.post('/api/notes/create', {_token: window.Laravel['csrfToken']})
                      .then(function(response) {
                            console.log(response.data);
                            if (response.data['success']) {
                                console.log('execute' + response.data['page_id']);
                                bus.$emit('updateComponents', response.data['page_id']);
                                bus.$emit('filterSidebar', '');
                            }
                        });
        }
    }
};
</script>