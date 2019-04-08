
require('./bootstrap');
import router from './router'
import store from './data/store'
import header from './components/partials/header.vue';
import footer from './components/partials/footer.vue';
window.Vue = require('vue');

Vue.component('header-vue',header);
Vue.component('footer-vue',footer);

const app = new Vue({
  router,
  store
}).$mount('#app')