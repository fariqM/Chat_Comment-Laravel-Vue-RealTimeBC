export default {
    setChatHistory(state, payload) {
        state.history.push(payload);
    },
    setConverse(state, payload) {
        state.converse.push(payload);
    }
};
