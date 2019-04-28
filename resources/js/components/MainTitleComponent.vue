<template>
        <div>
            <input type="text" class="title" v-model="title" />
        </div>
</template>

<script>
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
            }
        },
        created: function() {
            this.fetch(pageid);
        }

    }
</script>
