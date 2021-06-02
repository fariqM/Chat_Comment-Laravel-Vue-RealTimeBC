import state from "./AuthState"
import getters from "./AuthGetters"
import mutations from "./AuthMutations"
import actions from "./AuthActions"

export default {
    namespaced: true,
    state: state,
    mutations: mutations,
    actions: actions,
    getters: getters
}