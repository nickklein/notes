<template>
  <div>
    <vue-tags-input
      v-model="tag"
      :tags="tags"
			@before-adding-tag="addTag"
      @before-deleting-tag="removeTag"
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
		addTag(obj) {
			console.log(obj);
			this.$http.post('/api/tags/create', {page_id: pageid, tag_name: obj.tag.text,_token: window.Laravel['csrfToken']});
			obj.addTag();
		},
		removeTag(obj) {
			this.$http.post('/api/tags/remove', {page_id: pageid, tag_name: obj.tag.text,_token: window.Laravel['csrfToken']});
			obj.deleteTag();
		},
		fetch(pageid) {
			this.$http.get('/api/tag/' + pageid)
			.then(function(response) {
					console.log(response);
					this.tags = response.data.data;
			});
		}
	},
	created: function() {
			this.fetch(pageid);
	}
};
</script>