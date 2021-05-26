let mutations = {
    GET_COMMENTS(state, comments) {
        state.comments = comments;
    },
    ADD_COMMENT(state, comment) {
        state.comments = [...state.comments, comment];
    },
    GET_CHECK(state, payload) {
        state.cek = payload;
    }
};

export default mutations;
