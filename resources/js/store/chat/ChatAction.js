export default {
    async setChatHistory(state, payload) {
        state.commit("setChatHistory", payload);
    },
    async setConverse(state, payload){
        state.commit("setConverse", payload);
    }
};
