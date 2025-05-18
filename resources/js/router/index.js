import { createRouter, createWebHistory } from "vue-router";
import authService from "../services/authService";

const routes = [
    {
        path: "/",
        name: "welcome",
        component: () => import("../pages/Welcome.vue"),
        meta: {
            title: "Welcome",
            requiresAuth: false,
        },
    },
    {
        path: "/login",
        name: "login",
        component: () => import("../pages/auth/Login.vue"),
        meta: {
            title: "Login",
            requiresAuth: false,
        },
    },
    {
        path: "/dashboard",
        name: "dashboard",
        component: () => import("../pages/dashboard/Dashboard.vue"),
        meta: {
            title: "Dashboard",
            requiresAuth: true,
        },
        children: [
            {
                path: "",
                redirect: "/home"
            },
            {
                path: "/home",
                name: "Home",
                component: () => import("../pages/dashboard/Home/Home.vue"),
                meta: {
                    title: "Home",
                },
            },
            {
                path: "/data-master",
                children: [
                    {
                        path: "/users",
                        name: "users",
                        component: () =>
                            import(
                                "../pages/dashboard/data-master/users/Users.vue"
                            ),
                    },
                ],
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "font-semibold text-blue-500",
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = authService.isAuthenticated();

    if (to.meta.requiresAuth && isAuthenticated) {
        return next("/dashboard");
    }

    document.title = `Akreditasi | ${to.meta.title}`;
    next();
});

export default router;
