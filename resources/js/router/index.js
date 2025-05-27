import { createRouter, createWebHistory } from "vue-router";
import authService from "../services/authService";

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
                redirect: "/home",
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
                            import("../pages/dashboard/data-master/users/Users.vue"),
                    },
                ],
            },
            {
                path: "/validasi",
                name: "validasi",
                component: () => import("../pages/dashboard/Home/Validasi.vue"),
                meta: {
                    title: "Validasi",
                },
            },
            {
                path: "/dashboard-validasi",
                name: "dashboard-validasi",
                component: () => import("../pages/dashboard/Home/DashboardValidasi.vue"),
                meta: {
                    title: "Dashboard Validasi",
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
    {
        path: "/kriteria1",
        name: "kriteria1",
        component: () => import("../pages/kriteria/Kriteria1.vue"),
        meta: {
            title: "Kriteria 1",
        },
    },
    {
        path: "/kriteria2",
        name: "kriteria2",
        component: () => import("../pages/kriteria/Kriteria2.vue"),
        meta: {
            title: "Kriteria 2",
        },
    },
    {
        path: "/kriteria3",
        name: "kriteria3",
        component: () => import("../pages/kriteria/Kriteria3.vue"),
        meta: {
            title: "Kriteria 3",
        },
    },
    {
        path: "/kriteria4",
        name: "kriteria4",
        component: () => import("../pages/kriteria/Kriteria4.vue"),
        meta: {
            title: "Kriteria 4",
        },
    },
    {
        path: "/kriteria5",
        name: "kriteria5",
        component: () => import("../pages/kriteria/Kriteria5.vue"),
        meta: {
            title: "Kriteria 5",
        },
    },
    {
        path: "/kriteria6",
        name: "kriteria6",
        component: () => import("../pages/kriteria/Kriteria6.vue"),
        meta: {
            title: "Kriteria 6",
        },
    },
    {
        path: "/kriteria7",
        name: "kriteria7",
        component: () => import("../pages/kriteria/Kriteria7.vue"),
        meta: {
            title: "Kriteria 7",
        },
    },
    {
        path: "/kriteria8",
        name: "kriteria8",
        component: () => import("../pages/kriteria/Kriteria8.vue"),
        meta: {
            title: "Kriteria 8",
        },
    },
    {
        path: "/kriteria9",
        name: "kriteria9",
        component: () => import("../pages/kriteria/Kriteria9.vue"),
        meta: {
            title: "Kriteria 9",
        },
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
