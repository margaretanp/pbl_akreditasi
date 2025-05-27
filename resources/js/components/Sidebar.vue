<template>
    <div class="fixed left-0 flex h-full">
        <!-- Sidebar -->
        <div
            :class="[
                'bg-[#021526] text-white h-screen transition-all duration-300 ease-in-out',
                expanded ? 'w-64' : 'w-16',
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

                    <!-- Kriteria Dropdown -->
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
                            <li>
                                <router-link to="/kriteria1"
                                    >Kriteria 1</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria2"
                                    >Kriteria 2</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria3"
                                    >Kriteria 3</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria4"
                                    >Kriteria 4</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria5"
                                    >Kriteria 5</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria6"
                                    >Kriteria 6</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria7"
                                    >Kriteria 7</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria8"
                                    >Kriteria 8</router-link
                                >
                            </li>
                            <li>
                                <router-link to="/kriteria9"
                                    >Kriteria 9</router-link
                                >
                            </li>
                        </div>
                    </li>

                    <!-- Validasi - Only shown for validator roles -->

                    <li>
                    <router-link
                        to="/Validasi"
                        :class="[
                            'hover:bg-gray-800 rounded-lg text-white',
                            expanded ? 'flex items-center px-4 py-2' : 'p-2 flex justify-center',
                        ]"
                    >
                        <svg class="w-5 h-5" :class="expanded ? 'mr-3' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span v-if="expanded">Validasi</span>
                    </router-link>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            expanded: true,
            showKriteria: false,        
        };
    },
    methods: {
        toggleSidebar() {
            this.expanded = !this.expanded;
        },
        toggleKriteriaDropdown() {
            this.showKriteria = !this.showKriteria;
        },
    },
};
</script>

<style scoped>
/* Tambahkan style khusus jika dibutuhkan */
</style>
