<script setup>More actions
import { computed, ref } from "vue";
import axios from "axios";

import { useRoute, useRouter } from "vue-router";
import { useToast } from "vue-toast-notification";

import { authService } from "../services/authService";
import { useCurrentUserStore } from "../store/currentUser";

import Button from "../components/Button.vue";

const route = useRoute();
const router = useRouter();
const $toast = useToast();

const useCurrentUser = useCurrentUserStore();
const user = computed(() => useCurrentUser.currentUser);

const showKriteria = ref(false);

const activeKriteriaId = computed(() => {
    if (route.name === 'kriteria' && route.params.id) {
        return parseInt(route.params.id);
    }
    return null;
});

const isKriteriaActive = (kriteriaId) => {
    return activeKriteriaId.value === kriteriaId;
};

const toggleKriteriaDropdown = () => {
    showKriteria.value = !showKriteria.value;
};

const handleLogout = async () => {
    try {
        await axios.post("logout");

        authService.removeTokens();
        router.push("/");
    } catch (error) {
        console.error("Error:", error);
        $toast.error("Failed to logout");
    }
};

const onKriteriaRoute = (kriteriaId, event) => {
    event.preventDefault();

    // Check if user has the correct role
    if (user.value.role.id !== 5) {
        $toast.error("Anda tidak bisa membuka menu ini!");
        return;
    }

    // Map user IDs to their allowed kriteria IDs
    const userKriteriaMap = {
        7: 1,
        8: 2,
        9: 3,
        10: 4,
        11: 5,
        12: 6,
        13: 7,
        14: 8,
        15: 9,
    };

    const allowedKriteriaId = userKriteriaMap[user.value.id];

    // Check if clicked kriteria matches user's allowed kriteria
    if (kriteriaId !== allowedKriteriaId) {
        $toast.error("Anda hanya bisa mengakses Kriteria " + allowedKriteriaId);
        return;
    }

    router.push({ name: "kriteria", params: { id: kriteriaId } });
};
</script>

<template>
    <aside
        class="w-64 *:w-full h-full p-4 flex flex-col gap-y-8 overflow-y-auto bg-slate-900"
    >
        <!-- Header -->
        <h3 class="px-3 py-2 text-white font-bold text-xl">AKREDITASI</h3>

        <!-- Navigation -->
        <nav class="h-full flex flex-col justify-between text-gray-300">
            <div
                class="flex flex-col gap-y-3 *:px-3 *:py-2 *:inline-flex *:gap-x-3"
            >
                <!-- Dashboard -->
                <router-link :to="{ name: 'Home' }">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </router-link>

                <!-- Kriteria Dropdown hanya untuk Dosen -->
                <div
                    @click="toggleKriteriaDropdown"
                    class="cursor-pointer hover:text-white rounded-lg transition-all duration-200 ease-in-out px-3 py-2 inline-flex gap-x-3"
                    :class="{
                        'font-semibold text-white': showKriteria,
                    }"
                >
                    <i class="bi bi-clipboard"></i>
                    <div
                        class="inline-flex items-center justify-between w-full"
                    >
                        <span>Kriteria</span>
                        <i
                            class="bi bi-chevron-down transition-transform duration-200 ease-in-out"
                            :class="{
                                'transform rotate-180': showKriteria,
                            }"
                        ></i>
                    </div>
                </div>

                <!-- Dropdown Menu with Animation (Moved Outside) -->
                <div
                    v-if="showKriteria"
                    class="overflow-hidden transition-all duration-300 ease-in-out -mt-3"
                    :class="{
                        'max-h-96 opacity-100': showKriteria,
                        'max-h-0 opacity-0': !showKriteria,
                    }"
                >
                    <div
                        class="ml-6 flex flex-col gap-y-1 border-l-2 border-gray-700 pl-4"
                    >
                        <a
                            v-for="i in 9"
                            :key="i"
                            href="#"
                            class="px-3 py-2 hover:text-white rounded-md text-gray-400 text-sm transition-all duration-200 ease-in-out transform"
                            :class="{
                                'font-semibold text-white': isKriteriaActive(i),
                                'text-gray-400': !isKriteriaActive(i)
                            }"
                            @click="onKriteriaRoute(i, $event)"
                        >
                            Kriteria {{ i }}
                        </a>
                    </div>
                </div>

                <router-link to="/dashboard/validasi">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Validasi</span>
                </router-link>
            </div>

            <!-- Logout Button -->
            <Button
                variant="dangerFilled"
                justify="start"
                icon-position="left"
                @click="handleLogout()"
                >Logout
                <template #icon><i class="bi bi-box-arrow-right mr-3"></i></template
            ></Button>
        </nav>
    </aside>