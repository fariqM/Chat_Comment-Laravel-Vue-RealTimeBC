export default {
    setSidebarOpen(state, payload){
        // state.sidebarOpen != state.sidebarOpen
        state.sidebarOpen ? state.sidebarOpen = false : state.sidebarOpen = true
    },
    
    setSidenavOpen(state, payload){
        // state.sidebarOpen != state.sidebarOpen
        state.sidenavOpen ? state.sidenavOpen = false : state.sidenavOpen = true
    }

}
