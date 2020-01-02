<template>
    <div class="col-xl-9 col-lg-6 col-md-6 col-sm-6">
        <div class="mobile-menu">
            <ul class="back-menu">
                <li>
                    <a href="#" title="Favourite" v-on:click="back">
                        <svg width="32" height="32" viewBox="0 0 32 32"><path d="M12.586 27.414l-10-10c-0.781-0.781-0.781-2.047 0-2.828l10-10c0.781-0.781 2.047-0.781 2.828 0s0.781 2.047 0 2.828l-6.586 6.586h19.172c1.105 0 2 0.895 2 2s-0.895 2-2 2h-19.172l6.586 6.586c0.39 0.39 0.586 0.902 0.586 1.414s-0.195 1.024-0.586 1.414c-0.781 0.781-2.047 0.781-2.828 0z"></path></svg>
                    </a>
                </li>
            </ul>

            <ul class="right-tools">
                <li><a href="#"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M14 9.5c0-0.825 0.675-1.5 1.5-1.5h1c0.825 0 1.5 0.675 1.5 1.5v1c0 0.825-0.675 1.5-1.5 1.5h-1c-0.825 0-1.5-0.675-1.5-1.5v-1z"></path><path d="M20 24h-8v-2h2v-6h-2v-2h6v8h2z"></path><path d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"></path></svg></a></li>
                <li><a href="#" v-on:click="pin" :title="titlePin" :class="{active: activePin}"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M17 0l-3 3 3 3-7 8h-7l5.5 5.5-8.5 11.269v1.231h1.231l11.269-8.5 5.5 5.5v-7l8-7 3 3 3-3-15-15zM14 17l-2-2 7-7 2 2-7 7z"></path></svg></a></li>
                <li><a href="#" v-on:click="remove"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M4 10v20c0 1.1 0.9 2 2 2h18c1.1 0 2-0.9 2-2v-20h-22zM10 28h-2v-14h2v14zM14 28h-2v-14h2v14zM18 28h-2v-14h2v14zM22 28h-2v-14h2v14z"></path><path d="M26.5 4h-6.5v-2.5c0-0.825-0.675-1.5-1.5-1.5h-7c-0.825 0-1.5 0.675-1.5 1.5v2.5h-6.5c-0.825 0-1.5 0.675-1.5 1.5v2.5h26v-2.5c0-0.825-0.675-1.5-1.5-1.5zM18 4h-6v-1.975h6v1.975z"></path></svg></a></li>
                <li><a href="#"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M18.5 14h-0.5v-6c0-3.308-2.692-6-6-6h-4c-3.308 0-6 2.692-6 6v6h-0.5c-0.825 0-1.5 0.675-1.5 1.5v15c0 0.825 0.675 1.5 1.5 1.5h17c0.825 0 1.5-0.675 1.5-1.5v-15c0-0.825-0.675-1.5-1.5-1.5zM6 8c0-1.103 0.897-2 2-2h4c1.103 0 2 0.897 2 2v6h-8v-6z"></path></svg></a></li>
            </ul>

        </div>
        <ul class="left-tools">
            <li><a href="#"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M14 9.5c0-0.825 0.675-1.5 1.5-1.5h1c0.825 0 1.5 0.675 1.5 1.5v1c0 0.825-0.675 1.5-1.5 1.5h-1c-0.825 0-1.5-0.675-1.5-1.5v-1z"></path><path d="M20 24h-8v-2h2v-6h-2v-2h6v8h2z"></path><path d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"></path></svg></a></li>
            <li><a href="#" v-on:click="pin" :title="titlePin" :class="{active: activePin}"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M17 0l-3 3 3 3-7 8h-7l5.5 5.5-8.5 11.269v1.231h1.231l11.269-8.5 5.5 5.5v-7l8-7 3 3 3-3-15-15zM14 17l-2-2 7-7 2 2-7 7z"></path></svg></a></li>
            <li><a href="#" v-on:click="remove"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M4 10v20c0 1.1 0.9 2 2 2h18c1.1 0 2-0.9 2-2v-20h-22zM10 28h-2v-14h2v14zM14 28h-2v-14h2v14zM18 28h-2v-14h2v14zM22 28h-2v-14h2v14z"></path><path d="M26.5 4h-6.5v-2.5c0-0.825-0.675-1.5-1.5-1.5h-7c-0.825 0-1.5 0.675-1.5 1.5v2.5h-6.5c-0.825 0-1.5 0.675-1.5 1.5v2.5h26v-2.5c0-0.825-0.675-1.5-1.5-1.5zM18 4h-6v-1.975h6v1.975z"></path></svg></a></li>
            <li><a href="#"><svg width="32" height="32" viewBox="0 0 32 32"><path d="M18.5 14h-0.5v-6c0-3.308-2.692-6-6-6h-4c-3.308 0-6 2.692-6 6v6h-0.5c-0.825 0-1.5 0.675-1.5 1.5v15c0 0.825 0.675 1.5 1.5 1.5h17c0.825 0 1.5-0.675 1.5-1.5v-15c0-0.825-0.675-1.5-1.5-1.5zM6 8c0-1.103 0.897-2 2-2h4c1.103 0 2 0.897 2 2v6h-8v-6z"></path></svg></a></li>
        </ul>
    </div>
</template>

<script>
    import {bus} from '../app';

    export default {
        name: 'notes-main-toolbar',
        data() {
            return {
                activePin: false,
                titlePin: 'Pin'
            }
        },
        methods: {
            pin() {
                this.$http.post('/api/notes/pin', {page_id: pageid,_token: window.Laravel['csrfToken']})
                .then(function(response) {
                    if (response.data.success && response.data.action == 'add') {
                            this.titlePin = 'Unpin';
                            this.activePin = true;
                    }
                    if (response.data.success && response.data.action == 'delete') {
                            this.titlePin = 'Pin';
                            this.activePin = false;
                    }
                    bus.$emit('filterSidebar', '');
                });
            },
            remove() {                
                this.$http.post('/api/notes/remove', {page_id: pageid,_token: window.Laravel['csrfToken']})
                .then(function(response) {
                    if (response.data.success) {
                            bus.$emit('filterSidebar', '');
                    }
                });
            },
            back() {
                var sidebarContainer = document.querySelector('.sidebar-container');
                var mainWrap = document.querySelector('.main-wrap');

                sidebarContainer.classList.remove('slideOutSidebar');
                sidebarContainer.classList.add('slideInSidebar');
                mainWrap.classList.remove('slideInMain');
                mainWrap.classList.add('slideOutMain');
            }
        },
        created() {
            bus.$on('activePin', (status) => {
                this.titlePin = 'Pin';
                if (status) {
                    this.titlePin = 'Unpin';
                }
                this.activePin = status
            });
        }

    }
</script>
