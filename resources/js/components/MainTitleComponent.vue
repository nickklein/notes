<template>
        <div>
            <textarea  class="title" v-on:keydown="saveContent" v-model="title"></textarea>
        </div>
</template>

<script>
    import {bus} from '../app';

    export default {
        name: 'notes-title',
        data() {
            return {
                title: 'Type here'
            }
        },
        methods: {
            fetch: function(pageid) {
                this.$http.get('/api/note/' + pageid)
                .then(function(response) {
                    console.log(response);
                    this.title = response.data[0].note_title;
                });
            },
            saveContent: function() {
                this.$http.post('/api/notes/update', {page_id: pageid, title: this.title,_token: window.Laravel['csrfToken']});
            }
        },
        created: function() {
            this.fetch(pageid);

			bus.$on('updateComponents', (newid) => {
					this.fetch(newid);
            });

        }

    }
</script>
