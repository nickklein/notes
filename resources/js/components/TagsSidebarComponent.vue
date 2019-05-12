<template>
        <div class="btn-group">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tags
            </a>
            <div class="dropdown-menu scrollable-menu">
                <a class="dropdown-item" href="#" v-for="item in items">{{item.text}}</a>
            </div>
        </div>
</template>

<script>
    import {bus} from '../app';


    export default {
        name: 'tags-sidebar',
        data() {
            return {
                items: [],
            }
        },
        methods: {
            fetch: function() {
                this.$http.get('/api/tags/feed')
                .then(function(response) {
                    console.log(response.data.data);
                    this.items = response.data.data;
                });
            }
        },
        created: function() {
            this.fetch();

			bus.$on('updateTagsSidebar', () => {
                console.log('updateTagsSidebar');
				this.fetch();
			});
        }

    }
</script>
