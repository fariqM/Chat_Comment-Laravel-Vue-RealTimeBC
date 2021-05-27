import state from './ComptState'
import mutations from './ComptMutations'
import getters from './ComptGetters'
import actions from './ComptActions'

export default {
    namespaced: true,
    state: state,
    mutations: mutations,
    actions: actions,
    getters:getters
}