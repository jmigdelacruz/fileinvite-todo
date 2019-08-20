require('./bootstrap');
window.Vue = require('vue');
window.bus = new Vue();
Vue.component('todo-list', require('./components/todo-list.vue').default);

const app = new Vue({
    el: '#app',
});
