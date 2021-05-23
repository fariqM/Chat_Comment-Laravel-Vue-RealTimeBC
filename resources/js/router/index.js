import Login from '../views/Login'
import Register from '../views/Register'
import Master from '../views/layouts/Master'

export default {
    mode: 'history',

    routes: [
        {
            path: '/login',
            name: 'login.page',
            component: Login
        },
        {
            path: '/',
            name: 'register.page',
            component: Register
        },
        {
            path: '/dashboard',
            name: 'dashboard.page',
            component: Master
        }

    ]
}