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
        <li><router-link to="/profil" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">PROFIL</router-link></li>
        <li><router-link to="/visi" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">VISI</router-link></li>
        <li><router-link to="/misi" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">MISI</router-link></li>
        <li><router-link to="/tujuan" class="transition duration-200 hover:scale-110 hover:text-gray-300 hover:bg-transparent focus:outline-none">TUJUAN</router-link></li>
      </ul>
    </div>
  </div>
</template>

<script setup>
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
