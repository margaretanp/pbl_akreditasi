<script setup>
import axios from "axios";
import { computed, ref } from "vue";
import { authService } from "../services/authService";
import { useRouter } from "vue-router";
import { useToast } from "vue-toast-notification";
import { useCurrentUserStore } from "../store/currentUser";

const router = useRouter();
const $toast = useToast();

const useCurrentUser = useCurrentUserStore();
const user = computed(() => useCurrentUser.currentUser);

const expanded = ref(true);

const showKriteria = ref(false);

const toggleSidebar = () => {
    expanded.value = !expanded.value;
};

const toggleKriteriaDropdown = () => {
    showKriteria.value = !showKriteria.value;
};

const handleLogout = async () => {
    try {
        const response = await axios.post("logout");

        if (response.status === "success") {
            authService.removeTokens();
            router.push({ name: "welcome" });
        }
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
        15: 9
    };

    const allowedKriteriaId = userKriteriaMap[user.value.id];

    // Check if user is trying to access their assigned kriteria
    // if (!allowedKriteriaId) {
    //     $toast.error("Anda tidak memiliki akses di kriteria ini");
    //     return;
    // }

    // Check if clicked kriteria matches user's allowed kriteria
    if (kriteriaId !== allowedKriteriaId) {
        $toast.error("Anda hanya bisa mengakses Kriteria " + allowedKriteriaId);
        return;
    }

    router.push({ name: "kriteria", params: { id: kriteriaId } });
};
</script>

<template>
    <div class="flex h-full">
        <!-- Sidebar -->
        <div
            :class="[
                'bg-[#021526] text-white h-screen transition-all duration-300 ease-in-out',
                expanded ? 'w-60' : 'w-60',
                'flex flex-col',
            ]"
        >
            <!-- Logo Area -->
            <div
                class="p-4 flex items-center"
                :class="expanded ? 'justify-between' : 'justify-center'"
            >
                <div class="text-white font-bold text-xl">
                    {{ expanded ? "AKREDITASI" : "A" }}
                </div>
                <button
                    v-if="expanded"
                    @click="toggleSidebar"
                    class="text-white lg:hidden"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Search Bar -->
            <div v-if="expanded" class="px-4 pb-2">
                <div class="relative">
                    <span
                        class="absolute inset-y-0 left-0 flex items-center pl-3"
                    >
                        <svg
                            class="w-5 h-5 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </span>
                    <input
                        type="text"
                        placeholder="Search..."
                        class="w-full rounded-lg bg-gray-800 pl-10 pr-4 py-2 text-sm text-gray-300 focus:outline-none"
                    />
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul
                    :class="
                        expanded
                            ? 'px-2 space-y-2'
                            : 'flex flex-col items-center space-y-6'
                    "
                >
                    <!-- Dashboard -->
                    <li>
                        <router-link
                            to="/dashboard"
                            :class="[
                                'hover:bg-gray-800 rounded-lg text-white',
                                expanded
                                    ? 'flex items-center px-4 py-2'
                                    : 'p-2 flex justify-center',
                            ]"
                        >
                            <svg
                                class="w-5 h-5"
                                :class="expanded ? 'mr-3' : ''"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"
                                />
                            </svg>
                            <span v-if="expanded">Dashboard</span>
                        </router-link>
                    </li>

                    <!-- Kriteria Dropdown hanya untuk userRole ANG -->
                    <li>
                        <div
                            @click="toggleKriteriaDropdown"
                            :class="[
                                'flex items-center cursor-pointer hover:bg-gray-800 rounded-lg text-white',
                                expanded
                                    ? 'px-4 py-2 justify-between'
                                    : 'p-2 justify-center',
                                showKriteria ? 'bg-gray-800' : '',
                            ]"
                        >
                            <div class="flex items-center">
                                <svg
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                    />
                                </svg>
                                <span v-if="expanded" class="ml-3"
                                    >Kriteria</span
                                >
                            </div>
                            <svg
                                v-if="expanded"
                                class="w-4 h-4 transition-transform duration-200"
                                :class="{
                                    'transform rotate-180': showKriteria,
                                }"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </div>
                        <div
                            v-if="showKriteria"
                            class="mt-2"
                            :class="expanded ? 'ml-8 space-y-1' : 'space-y-1'"
                        >
                            <li v-for="i in 9" :key="'kriteria-' + i">
                                <a
                                    href="#"
                                    class="block px-4 py-2 hover:bg-gray-700 rounded text-white text-sm"
                                    @click="onKriteriaRoute(i, $event)"
                                >
                                    Kriteria {{ i }}
                                </a>
                            </li>
                        </div>
                    </li>

                    <li>
                        <router-link
                            to="/Validasi"
                            :class="[
                                'hover:bg-gray-800 rounded-lg text-white',
                                expanded
                                    ? 'flex items-center px-4 py-2'
                                    : 'p-2 flex justify-center',
                            ]"
                        >
                            <svg
                                class="w-5 h-5"
                                :class="expanded ? 'mr-3' : ''"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                            <span v-if="expanded">Validasi</span>
                        </router-link>
                    </li>
                </ul>
            </nav>

            <!-- Logout Button -->
            <div class="px-4 pb-4" v-if="expanded">
                <button
                    @click="handleLogout"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300"
                >
                    Logout
                </button>
            </div>
            <div class="pb-4 flex justify-center" v-else>
                <button
                    @click="handleLogout"
                    class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full transition duration-300"
                    title="Logout"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped>
/* Tambahan style jika diperlukan */
</style>
