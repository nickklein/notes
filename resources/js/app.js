
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import vueResource from 'vue-resource';
Vue.use(vueResource)

export const bus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('search-sidebar', require('./components/SearchComponent.vue').default);
Vue.component('notes-sidebar', require('./components/NotesSidebarComponent.vue').default);
Vue.component('tags-sidebar', require('./components/TagsSidebarComponent.vue').default);
Vue.component('notes-tags', require('./components/MainTagsComponent.vue').default);
Vue.component('create-note', require('./components/CreateNoteComponent.vue').default);
Vue.component('notes-toolbar', require('./components/ToolbarComponent.vue').default);
Vue.component('notes-tinymce', require('./components/tinyMCEComponent.vue').default);
Vue.component('static-modal', require('./components/StaticModalComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        showModal: false,
        test: ''
    }

    // created: function() {
    //     setInterval(function () {
    //         bus.$emit('saveContent', 'tempora');
    //     }.bind(this), 10000); 
    // }
});
