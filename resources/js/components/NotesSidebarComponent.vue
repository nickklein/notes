<template>
        <ul class="notes-container">
            <li class="note" v-for="(item, index) in items">
                <a href="#" :note-id="item.note_id">
                    <h5>{{item.note_title}}</h5>
                    <p class="caption">{{item.note_content}}</p>
                </a>
            </li>
        </ul>
</template>

<script>
    import {bus} from '../app';


    export default {
        name: 'notes-sidebar',
        data() {
            return {
                items: [],
            }
        },
        created: function() {
            this.$http.get('/api/notes/feed/')
            .then(function(response) {
                this.items = response.data;
            });

            bus.$on('filterSidebar', (search) => {
                this.$http.get('/api/notes/feed/' + search)
                .then(function(response) {
                    this.items = response.data;
                });
            });
        }

    }
</script>
