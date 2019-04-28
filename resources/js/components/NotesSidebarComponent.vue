<template>
        <ul class="notes-container">
            <li class="note" v-for="(item, index) in items">
                <a href="#" v-on:click="changeNote" :note_id="item.note_id">
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
        methods: {
            fetch: function(search = '') {
                this.$http.get('/api/notes/feed/' + search)
                .then(function(response) {
                    this.items = response.data;
                });
            },
            changeNote: function(event) {
                var newid = event.currentTarget.getAttribute('note_id');
                pageid = newid;

                history.pushState(null, '', '/app#' + newid);

                bus.$emit('updateComponents', newid);
            }
        },
        created: function() {
            this.fetch();

            bus.$on('filterSidebar', (search) => {
                this.fetch(search);
            });
        }

    }
</script>
