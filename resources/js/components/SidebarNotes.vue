<template>
        <ul class="notes">
            <li class="note" v-for="(item, index) in items" :key="index">
                <a href="#" v-on:click="changeNote" :class="{active:item.note_id == selected, pinned:item.pinned}" :note_id="item.note_id">
                    <h5>{{item.note_title}}</h5>
                    <p class="caption">{{item.note_caption}}</p>
                    <span></span>
                </a>
            </li>
        </ul>
</template>

<script>
    import {bus} from '../app';


    export default {
        name: 'notes-sidebar-notes',
        data() {
            return {
                items: [],
                selected: pageid,
                pinnedNote: false
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
                var note_id = event.currentTarget.getAttribute('note_id');

                pageid = note_id;

                history.pushState(null, '', '/app#' + note_id);
                bus.$emit('updateComponents', note_id);

                this.selected = note_id;                
                
                var sidebarContainer = document.querySelector('.sidebar-wrapper');
                var mainWrap = document.querySelector('.main-wrapper');

                sidebarContainer.classList.remove('slideInSidebar');
                sidebarContainer.classList.add('slideOutSidebar');
                mainWrap.classList.remove('slideOutMain');
                mainWrap.classList.add('slideInMain');
            },
        },
        created: function() {
            this.fetch();

            bus.$on('filterSidebar', (search) => {
                this.fetch(search);
            });

            bus.$on('updateComponents', (note_id) => {
                this.selected = note_id;
            });

        }

    }
</script>
<style scoped>

</style>