export default {
    async setChatHistory(state, payload) {
        // Call API for chat histories here
        state.commit("setChatHistory", payload);
    },
    async setContacts(state, payload) {
        // Call API for contacts here
        state.commit("setContacts", payload);
    },
    async setDumpHistory(state){
        state.commit("setDumpHistory");
    }
};
