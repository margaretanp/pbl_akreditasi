<template>
  <div class="navbar bg-blue-600">
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
  <li><router-link to="/profil" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">{{ t('menu.profil') }}</router-link></li>
  <li><router-link to="/visi" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">{{ t('menu.visi') }}</router-link></li>
  <li><router-link to="/misi" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">{{ t('menu.misi') }}</router-link></li>
  <li><router-link to="/tujuan" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">{{ t('menu.tujuan') }}</router-link></li>
</ul>


      <!-- Language Switch -->
      <div class="relative inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-2 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-600 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 0v8m0 0h4m-4 0H8" />
        </svg>
        <select
          v-model="currentLocale"
          @change="changeLanguage"
          class="pl-8 pr-4 py-1 bg-white text-gray-800 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
        >
          <option value="id">ID</option>
          <option value="en">EN</option>
        </select>
      </div>
    </div>
  </div>
</template>


<script setup>
import { useI18n } from 'vue-i18n'
import { ref, watch } from 'vue'

const { t, locale } = useI18n()
const currentLocale = ref(locale.value)

function changeLanguage() {
  locale.value = currentLocale.value
  localStorage.setItem('userLanguage', currentLocale.value)
}

watch(locale, (newVal) => {
  currentLocale.value = newVal
})

const savedLanguage = localStorage.getItem('userLanguage')
if (savedLanguage) {
  locale.value = savedLanguage
  currentLocale.value = savedLanguage
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