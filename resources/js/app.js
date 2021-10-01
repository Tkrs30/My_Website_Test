require('./bootstrap');

require('alpinejs');

// Require Vue
window.Vue = require('vue').default;


import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)

// Register Vue Components
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Initialize Vue
const app = new Vue({
    el: '#app',
});