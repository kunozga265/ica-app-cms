
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import router from './router';
import App from './layouts/App.vue';

import Vuetify from "vuetify";
import 'vuetify/dist/vuetify.min.css'

import store from "./store";


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.use(Vuetify);
const vuetifyOptions={
    theme:{
        themes:{
            light:{
                primary: '#3f3f3f',
                secondary: '#5b5b5b',
                tertiary: '#001F56',
                other: '#00398C',
                accent: '#f9f9f9',
                error: '#FF5252',
                info: '#2196F3',
                success: '#4CAF50',
                warning: '#FFC107',
                app_color: '#292929'
            }
        }
    }};

const app = new Vue({
    router,
    store,
    vuetify:new Vuetify(vuetifyOptions),
    el: '#app',
    render: h => h(App)
});
