export default {
    setChatHistory(state, payload) {
        state.history.push(payload);
    },
    setConverse(state, payload) {
        state.converse.push(payload);
    },
    setContacts(state, payload) {
        state.contacts.push(payload);
    },
    setDumpHistory(state){
        state.history = []
    }
};
