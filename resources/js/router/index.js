import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../pages/Home.vue"),
        meta: {
            title: "Home",
        },
    },
    {
        path: '/login',
        name: 'login',
        component: () => import("../pages/auth/Login.vue"),
        meta: {
            title: "Login",
        }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");

    if (to.meta.requreAuth && !token) {
        document.title = `Akred | ${to.meta.title}`;
        next("/login");
    } else {
        next();
    }
});

export default router;
