<!-- components/Sidebar.vue -->
<script setup>
import logo from "../assets/polinema.png";
import { useRoute } from "vue-router";

const route = useRoute();
</script>

<template>
    <aside class="w-fit h-screen bg-white shadow-lg p-6 flex flex-col gap-y-6">
        <div class="flex items-center gap-4 mb-4">
            <img :src="logo" alt="Polinema Logo" class="w-12 h-12" />
            <span class="text-lg font-semibold">Sistem Akreditasi SIB</span>
        </div>

        <ul class="menu bg-base-200 rounded-box w-56">
            <li class="menu-title">
                <router-link to="/home"> Home </router-link>
            </li>

            <details>
                <summary>Kriteria</summary>
                <ul class="menu-dropdown">
                    <li><router-link>Kriteria 1</router-link></li>
                    <li><router-link>Kriteria 2</router-link></li>
                    <li><router-link>Kriteria 3</router-link></li>
                    <li><router-link>Kriteria 4</router-link></li>
                    <li><router-link>Kriteria 5</router-link></li>
                    <li><router-link>Kriteria 6</router-link></li>
                    <li><router-link>Kriteria 7</router-link></li>
                    <li><router-link>Kriteria 8</router-link></li>
                    <li><router-link>Kriteria 9</router-link></li>
                </ul>
            </details>

            <ul>
                <span>Data Master</span>
                <li>
                    <router-link to="/users"> Users </router-link>
                </li>
            </ul>
        </ul>
    </aside>
</template>
