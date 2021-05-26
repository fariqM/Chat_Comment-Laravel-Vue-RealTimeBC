// import Vue from "vue";
// import Vuex from "vuex";
import state from './ChatState'
import mutations from './ChatMutation'
import actions from './ChatAction'
import getters from './ChatGetters'

// Vue.use(Vuex);

export default {
    namespaced: true,
    state: state,
    mutations: mutations,
    actions: actions,
    getters:getters
};
