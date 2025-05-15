import { createRouter, createWebHistory } from "vue-router";
import authService from "../services/authService";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../pages/Home.vue"),
        meta: {
            title: "Home",
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
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
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
