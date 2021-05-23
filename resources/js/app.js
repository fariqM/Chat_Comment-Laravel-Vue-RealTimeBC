require('./bootstrap')


window.Vue = require("vue").default;

import store from './store/index'
import VueRouter from "vue-router";
import routes from "./router";
import VueIziToast from 'vue-izitoast';

import "izitoast/dist/css/iziToast.css";

Vue.use(VueRouter);
Vue.use(VueIziToast)

Vue.component("comment", require("./components/Comment").default);
Vue.component("comments", require("./components/Comments").default);
Vue.component("new-comment", require("./components/NewComment").default);

const app = new Vue({
  el: '#app',
  store,
  mode: "history",
  router: new VueRouter(routes)
});



