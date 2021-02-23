// require('./bootstrap');
import Vue from 'vue'
import App from "./components/App";
import VueRouter from "vue-router";
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.use(VueRouter);




const authRequired = (to, from, next) => {
  if (localStorage.getItem('token') != null && localStorage.getItem('token').length > 0) {
    next()
  } else {
    localStorage.removeItem('token')
    next('/login')
  }
};


const routes = [
  {
    path: '/',
    component: () => import(/* webpackChunkName: "setting" */ './components/HomePage'),
    beforeEnter: authRequired
  },
  {
    path: '/login',
    component: () => import(/* webpackChunkName: "setting" */ './components/LoginPage'),
  }
];

const router = new VueRouter({
  mode: 'history',
  routes
});

new Vue({
  router,
  render: h => h(App)
}).$mount("#root");

