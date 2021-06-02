import axios from "axios";

export default {
    async setCurrentUser(state) {
        let { data } = await axios.get("/api/getcurrent-user");
        state.commit("setCurrentUser", data);
        // console.log("lewattt");
    },
    async setCurrentUsers(state, payload) {
        state.commit("setCurrentUser", payload);
        // console.log("lewattt222");
    }
};