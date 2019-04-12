<template>
        <ul class="notes-container">
            <li class="note" v-for="item in items">
                <a href="#">
                    <h5>{{item.note_title}}</h5>
                    <p class="caption">{{item.note_content}}</p>
                </a>
            </li>
        </ul>
</template>

<script>
    export default {
        name: 'notes-sidebar',
        data() {
            return {
                items: [],
            }
        },
        created: function() {
            var search = 'est';
            this.$http.get('/notes/feed/' + search)
            .then(function(response) {
                this.items = response.data;
            });
        }

    }
</script>
