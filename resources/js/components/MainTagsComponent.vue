<template>
  <div>
    <vue-tags-input
      v-model="tag"
      :tags="tags"
    />
  </div>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
	name: 'tags',
	components: {
		VueTagsInput
	},
	data() {
		return {
			tag: '',
			tags: [],
		};
	},
	methods: {
		// addTag(obj) {
		// 	this.$http.post(site_url + '/api/settings/tags/create', {tagName: obj.tag.text,_token: window.Laravel['csrfToken']});
		// 	obj.addTag();
		// },
		// removeTag(obj) {

		// 	this.$http.post(site_url + '/api/settings/tags/remove', {tagName: obj.tag.text,_token: window.Laravel['csrfToken']});
		// 	obj.deleteTag();
		// }
	},
	created: function() {
        // this.$http.get('tags/all-tags')
        // .then(function(response) {
        //     console.log(response.data);
        //     this.tags = response.data;
        // });
	}
};
</script>