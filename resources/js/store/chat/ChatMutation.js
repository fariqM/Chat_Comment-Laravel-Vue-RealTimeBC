export default {
    setChatHistory(state, payload) {
        state.history.push(payload);
    },
    setContacts(state, payload) {
        state.contacts.push(payload);
    },
    setDumpHistory(state){
        state.history = []
    }
};
