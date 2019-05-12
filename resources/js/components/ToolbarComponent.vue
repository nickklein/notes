<template>       
    <ul class="left-tools col-xl-10 col-md-10 col-sm-8">
        <li><a href="#"><img title="Info" src="/images/icons/info.svg" alt="info"></a></li>
        <li><a href="#"><img title="Favourite" src="/images/icons/pushpin.svg" alt="Favourite"></a></li>
        <li><a href="#" v-on:click="deleteNote"><img title="Delete" src="/images/icons/bin.svg" alt="Delete"></a></li>
        <li><a href="#"><img title="Encrypt" src="/images/icons/lock.svg" alt="Encrypt"></a></li>

    </ul>
</template>

<script>
    import {bus} from '../app';

    export default {
        name: 'toolbar',
        methods: {
            deleteNote() {                
                this.$http.post('/api/notes/remove', {page_id: pageid,_token: window.Laravel['csrfToken']});
                bus.$emit('filterSidebar', '');
            }
        }

    }
</script>
