require('./bootstrap');

require('alpinejs');

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Initialize Vue
const app = new Vue({
    el: '#app',
});