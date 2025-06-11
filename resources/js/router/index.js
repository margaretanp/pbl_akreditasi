import { createRouter, createWebHistory } from "vue-router";
import { authService } from "../services/authService";

const routes = [
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
        path: "/",
        name: "welcome",
        component: () => import("../pages/landingpage/Welcome.vue"),
        meta: {
            title: "Welcome",
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
            { path: "", name: "dashboard-home", redirect: { name: "Home" } },
            {
                path: "home",
                name: "Home",
                component: () => import("../pages/dashboard/home/Home.vue"),
                meta: {
                    title: "Home",
                },
            },
            {

                path: "validasi",
                name: "validasi",
                component: () => import("../pages/dashboard/home/Validasi.vue"),
                meta: {
                    title: "Validasi",
                },
            },
            {
                path: "kriteria/:id",
                name: "kriteria",
                component: () => import("../pages/dashboard/kriteria/Kriteria.vue"),
                meta: {
                    title: "Kriteria",
                },
            },
        ],
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
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "font-semibold text-white",
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = authService.isAuthenticated();

    if (to.meta.requiresAuth && !isAuthenticated) {
        return next("/login");
    }

    if (isAuthenticated && to.name === "login") {
        return next({ name: "Home" });
    }

    document.title = `Akreditasi | ${to.meta.title}`;
    next();
});

export default router;
