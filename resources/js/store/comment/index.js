import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import mutations from './mutations'
import getters from './getters'
import state from "./state";
import authStore from "../auth/AuthStore"

Vue.use(Vuex);

export default new Vuex.Store({
    state,
    mutations,
    getters,
    modules: {
        auth: authStore
    },
    actions
})