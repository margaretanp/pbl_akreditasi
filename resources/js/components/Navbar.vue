<template>
  <div class="navbar">
    <div class="flex-1">
      <router-link
        to="/"
        class="btn btn-ghost font-sans md:font-helvetica text-3xl font-bold text-transparent bg-clip-text hover:scale-110 hover:text-gray-300 transition duration-200 hover:bg-transparent focus:outline-none"
        style="background-image: linear-gradient(to right, #ffff);"
      >
        AKREDITASI
      </router-link>
    </div>
    <div class="text-white">
      <ul class="menu menu-horizontal px-1 font-helvetica text-lg space-x-4">
<router-link to="/profil">{{ $t('menu.profil') }}</router-link>
<router-link to="/visi">{{ $t('menu.visi') }}</router-link>
<router-link to="/misi">{{ $t('menu.misi') }}</router-link>
<router-link to="/tujuan">{{ $t('menu.tujuan') }}</router-link>

      </ul>
      <div class="ml-4">
  <select @change="changeLanguage($event)" class="bg-transparent text-white border border-white rounded px-2 py-1 focus:outline-none hover:scale-105 transition duration-200"
  >
    <option value="id">Indonesia</option>
    <option value="en">English</option>
  </select>
</div>

    </div>
  </div>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()

function changeLanguage(event) {
  locale.value = event.target.value
}
</script>

<style scoped>
.navbar {
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  width: 100%;
  max-width: 1200px;
  background-color: #021526;
  color: white;
  padding: 1rem 2rem;
  border-radius: 16px;
  z-index: 999;
  
}

.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}


</style>
