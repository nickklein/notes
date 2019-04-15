<template>
    <div>
     <editor api-key="xi75lgpx8te8lp53zmlfxo54bolufdlza2jow261unsyief8"  v-model="content" :init="{selector: '.funnyjoke', inline: true,menubar: false, plugins: 'wordcount'}">
         This is a paragraph
     </editor>
    </div>
</template>


<script>
import Editor from '@tinymce/tinymce-vue';

export default {
	name: 'tinymce',
	components: {
		Editor
    },
    data() {
        return {
            content: 'Type here'
        }
    },
    methods: {},
    created() {
        this.$http.get('/note/' + pageid)
        .then(function(response) {
            this.content = response.data[0].note_content;
        });
    }
};
</script>