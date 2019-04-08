import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/home';
import Create from './components/create';
import Update from './components/update';

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/create',
      name: 'create',
      component: Create
    },
    {
      path: '/update',
      name: 'update',
      component: Update
    },
  ]
})
