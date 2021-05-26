export default {
    async setChatHistory(state, payload) {
        state.commit("setChatHistory", payload);
    },
    async setConverse(state, payload){
        state.commit("setConverse", payload);
    },
    async setContacts(state, payload) {
        state.commit("setContacts", payload);
    },
    async setDumpHistory(state){
        state.commit("setDumpHistory");
    }
};
