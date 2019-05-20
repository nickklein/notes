<template>
    <div class="editor">
     <editor api-key="xi75lgpx8te8lp53zmlfxo54bolufdlza2jow261unsyief8"
        v-model="content" 
        @onFocusOut="saveContent"
        @onFocusIn="toolBar"
        :init="{
        branding: false, 
        height: '500px', 
        menubar: false,
        mobile: {
            theme: 'silver'
        },

        toolbar: 'formatselect | bold italic strikethrough forecolor permanentpen formatpainter | link image | alignleft aligncenter alignright alignjustify  | numlist bullist | removeformat | addcomment', 
        plugins: 'advlist autolink lists link image charmap print preview anchor textcolor searchreplace visualblocks code fullscreen insertdatetime media table paste code help'}">
         This is a paragraph
     </editor>
    </div>
</template>
<script>


import Editor from '@tinymce/tinymce-vue';
import {bus} from '../app';


export default {
	name: 'notes-tinymce',
	components: {
		Editor
    },
    data() {
        return {
            content: 'Type here'
        }
    },
    methods: {
        fetch: function(pageid) {
            this.$http.get('/api/note/' + pageid)
            .then(function(response) {
                this.content = response.data[0].note_content;
            });
        },
        saveContent: function() { 
            this.$http.post('/api/notes/update', {page_id: pageid, content: this.content,_token: window.Laravel['csrfToken']});
            bus.$emit('filterSidebar', '');
        },
        toolBar: function() {
            console.log(tinyMCE);
        }
    },
    created() {
        this.fetch(pageid);

        bus.$on('updateComponents', (newid) => {
            this.fetch(newid);
        });
    }
};
</script>