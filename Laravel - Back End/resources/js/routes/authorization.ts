import Login from "@src/views/Login.vue"
const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
        meta: {
            auth: false,
            guest: true
        }
    }
]

export default routes
