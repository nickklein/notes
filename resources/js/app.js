
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

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

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
Vue.component('notes-sidebar-search', require('./components/SidebarSearch.vue').default);
Vue.component('notes-sidebar-notes', require('./components/SidebarNotes.vue').default);
Vue.component('notes-main-tags', require('./components/MainTags.vue').default);
Vue.component('create-note', require('./components/CreateNote.vue').default);
Vue.component('notes-main-toolbar', require('./components/MainToolbar.vue').default);
Vue.component('notes-main-title', require('./components/MainTitle.vue').default);
Vue.component('notes-main-tiptap', require('./components/tipTap.vue').default);
//Vue.component('notes-tinymce', require('./components/tinyMCE.vue').default);
Vue.component('static-modal', require('./components/StaticModal.vue').default);


// Passport
//Vue.component('passport-client', require('./components/passport/Clients.vue').default);
//Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
//Vue.component('passport-personal-access-token', require('./components/passport/PersonalAccessTokens.vue').default);


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