import Login from "../views/Login";
import Register from "../views/Register";
import Master from "../views/layouts/Master";
import Home from "../views/pages/Home"
import ChatRoom from "../views/pages/Chat"


export default {
    mode: "history",

    routes: [
        {
            path: "/login",
            name: "login.page",
            component: Login
        },
        {
            path: "/",
            name: "register.page",
            component: Register
        },
        {
            path: "/dashboard",
            name: "dashboard.page",
            component: Master,
            children: [
                {
                    path: "home",
                    name: "home",
                    component: Home
                },
                {
                    path: "chat",
                    name: "chat",
                    component: ChatRoom
                },
            ]
        },
        
    ]
};
