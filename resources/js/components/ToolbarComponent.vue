<template>
    <div class="col-xl-10 col-md-10 col-sm-8">
        <div class="mobile-menu row">
            <ul class="back-menu">
                <li><a href="#" v-on:click="back"><img title="Favourite" src="/images/icons/left-arrow.svg" alt="Go back"></a></li>
            </ul>

            <div class="right-tools btn-group">
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img title="Info" src="/images/icons/menu.svg" alt="info">
                </a>
                <div class="dropdown-menu scrollable-menu">
                    <a class="dropdown-item" href="#">Info</a>
                    <a class="dropdown-item" href="#">Favourite</a>
                    <a class="dropdown-item" href="#">Delete</a>
                    <a class="dropdown-item" href="#">Encrypt</a>
                </div>
            </div>
        </div>
        <ul class="left-tools col-xl-10 col-md-10 ">
            <li><a href="#"><img title="Info" src="/images/icons/info.svg" alt="info"></a></li>
            <li><a href="#" v-on:click="pin"><img title="Favourite" src="/images/icons/pushpin.svg" alt="Favourite"></a></li>
            <li><a href="#" v-on:click="remove"><img title="Delete" src="/images/icons/bin.svg" alt="Delete"></a></li>
            <li><a href="#"><img title="Encrypt" src="/images/icons/lock.svg" alt="Encrypt"></a></li>
        </ul>
    </div>
</template>

<script>
    import {bus} from '../app';

    export default {
        name: 'notes-toolbar',
        methods: {
            pin() {
                this.$http.post('/api/notes/pin', {page_id: pageid,_token: window.Laravel['csrfToken']});
            },
            remove() {                
                this.$http.post('/api/notes/remove', {page_id: pageid,_token: window.Laravel['csrfToken']});
                bus.$emit('filterSidebar', '');
            },
            back() {
                var sidebarContainer = document.querySelector('.sidebar-container');
                var mainWrap = document.querySelector('.main-wrap');

                sidebarContainer.classList.remove('slideOutSidebar');
                sidebarContainer.classList.add('slideInSidebar');
                mainWrap.classList.remove('slideInMain');
                mainWrap.classList.add('slideOutMain');
            }
        }

    }
</script>
