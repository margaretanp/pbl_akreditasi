<template>
  <nav class="navbar">
    <div class="flex-1"></div>

    <div class="flex items-center space-x-4">
      <router-link to="/profil" class="nav-link">{{ $t('menu.profil') }}</router-link>
      <router-link to="/visi" class="nav-link">{{ $t('menu.visi') }}</router-link>
      <router-link to="/misi" class="nav-link">{{ $t('menu.misi') }}</router-link>
      <router-link to="/tujuan" class="nav-link">{{ $t('menu.tujuan') }}</router-link>

      <select 
        v-model="currentLocale"
        @change="changeLanguage"
        class="lang-switch"
      >
        <option value="id">ID</option>
        <option value="en">EN</option>
      </select>
    </div>
  </nav>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import { ref, watch } from 'vue'

const { locale } = useI18n()
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
  background-color: #021526;
  padding: 1rem 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  z-index: 50;
  width: 100%;
}



.brand {
  font-size: 1.75rem;
  font-weight: bold;
  text-transform: uppercase;
  background: linear-gradient(to right, white, white);
  color: transparent;
  -webkit-background-clip: text;
  background-clip: text;
  transition: transform 0.2s;
}

.brand:hover {
  transform: scale(1.05);
}

.nav-link {
  color: white;
  text-decoration: none;
  font-weight: 500;
  transition: all 0.2s ease;
}

.nav-link:hover,
.nav-link.router-link-exact-active {
  color: #a0c4ff;
  font-weight: bold;
  transform: scale(1.05);
}

.lang-switch {
  background-color: white;
  color: #021526;
  font-weight: bold;
  border: none;
  border-radius: 6px;
  padding: 0.25rem 0.5rem;
  cursor: pointer;
  transition: transform 0.2s;
}

.lang-switch:hover {
  transform: scale(1.05);
}
</style>
