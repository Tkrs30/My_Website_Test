require('./bootstrap');

require('alpinejs');

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('edit-component', require('./components/EditComponent.vue').default);
//Vue.component('index-component', require('./components/IndexComponent.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});