<template>
    <div class="editor">
     <editor api-key="xi75lgpx8te8lp53zmlfxo54bolufdlza2jow261unsyief8"
        v-model="content" 
        @input="saveContent"
        :init="{
        branding: false, 
        height: '500px',
        inline: false,
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
                console.log(response.data[0].nsetting_id);
                var activePin = false;
                if (response.data[0].nsetting_id !== null && response.data[0].nsetting_id == '2') {
                    activePin = true;
                }
                bus.$emit('activePin', activePin);
                this.content = response.data[0].note_content;
            });
        },
        saveContent: _.debounce(function () {
            this.$http.post('/api/notes/update', {
                type: 'content',
                page_id: pageid, 
                content: this.content,
                _token: window.Laravel['csrfToken']
            });
            bus.$emit('filterSidebar', '');
        }, 500)
    },
    created() {
        this.fetch(pageid);

        bus.$on('updateComponents', (newid) => {
            this.fetch(newid);
        });
    }
};
</script>