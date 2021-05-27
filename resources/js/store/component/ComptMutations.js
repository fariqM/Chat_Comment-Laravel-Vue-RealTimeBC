export default {
    setSidebarOpen(state, payload){
        // state.sidebarOpen != state.sidebarOpen
        state.sidebarOpen ? state.sidebarOpen = false : state.sidebarOpen = true
    }
}
