<template>
  <div class="navbar bg-base-100 shadow-sm h-32 max-h-32 md:max-h-screen">
  <div class="flex-1">
    <a class="btn btn-ghost font-sans md:font-serif text-4xl font-bold text-transparent bg-clip-text"
        style="background-image: linear-gradient(to right, #12086f, #2b35af, #4361ee);">AKREDITASI</a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1 font-sans md:font-serif text-lg text-base md:text-3xl " style="color: #12086f">
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/profil">Profil</router-link></li>
      <li><router-link to="/visi">Visi</router-link></li>
      <li><router-link to="/misi">Misi</router-link></li>
      <li><router-link to="/tujuan">Tujuan</router-link></li>
    </ul>
  </div>
</div>
    <!-- Navbar end jika diperlukan -->
    <!-- <div class="navbar-end">
      <button class="btn">Login</button>
    </div> -->

</template>

<script setup>
</script>

<style scoped>
.router-link-exact-active {
  font-weight: bold;
  text-decoration: underline;
}
</style>
