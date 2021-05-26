require("./bootstrap");

window.Vue = require("vue").default;

import store from "./store/comment/index";
// import store from "./store/chat/ChatStore"

import Vuesax from "vuesax";
import "vuesax/dist/vuesax.css"; //Vuesax styles
import vuescroll from 'vuescroll';

import VueRouter from "vue-router";
import routes from "./router";
import VueIziToast from "vue-izitoast";
import "izitoast/dist/css/iziToast.css";


Vue.use(VueRouter);
Vue.use(VueIziToast);
Vue.use(Vuesax, {
  // options here
});
Vue.use(vuescroll, {
  ops: {
    // The global config
  },
  name: 'myScroll' // customize component name, default -> vueScroll
});
Vue.component("comment", require("./components/Comment").default);
Vue.component("comments", require("./components/Comments").default);
Vue.component("new-comment", require("./components/NewComment").default);

const app = new Vue({
    el: "#app",
    store,
    // CommentStore,
    mode: "history",
    router: new VueRouter(routes)
});




