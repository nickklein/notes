<template>
        <div>
            <input class="title" placeholder="This is your title" @input="saveContent" v-model="title"/>
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
                    this.title = response.data[0].note_title;
                });
            },
            saveContent: _.debounce(function () {
                this.$http.post('/api/notes/update', {
                    type: 'title',
                    page_id: pageid, 
                    title: this.title,
                    _token: window.Laravel['csrfToken']
                });
            }, 500)
        },
        created: function() {
            this.fetch(pageid);

			bus.$on('updateComponents', (newid) => {
					this.fetch(newid);
            });

        }

    }
</script>
