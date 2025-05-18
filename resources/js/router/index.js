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
        },
    },
    {
        path: "/profil",
        name: "profil",
        component: () => import("../pages/landingpage/Profil.vue"),
        meta: {
            title: "Profil",
        },
    },
    {
        path: "/visi",
        name: "visi",
        component: () => import("../pages/landingpage/Visi.vue"),
        meta: {
            title: "Visi",
        },
    },
    {
        path: "/misi",
        name: "misi",
        component: () => import("../pages/landingpage/Misi.vue"),
        meta: {
            title: "Misi",
        },
    },
    {
        path: "/tujuan",
        name: "tujuan",
        component: () => import("../pages/landingpage/Tujuan.vue"),
        meta: {
            title: "Tujuan",
        },
    },
    {
    path: "/kriteria",
    name: "kriteria",
    component: () => import("../pages/dashboard/Kriteria.vue"),
    meta: {
        title: "Kriteria",
    },
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
