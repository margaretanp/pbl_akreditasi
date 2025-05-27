<script setup>
import { inject } from 'vue'
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()
const $changeLocale = inject('app').config.globalProperties.$changeLocale

function setLocale (loc) {
  if (loc !== locale.value) $changeLocale(loc)
}
</script>

<template>
  <div class="flex gap-2 items-center">
    <button
      v-for="loc in ['en','id']"
      :key="loc"
      :class="[
        'px-2 py-1 rounded',
        locale === loc ? 'bg-sky-600 text-white' : 'bg-gray-200'
      ]"
      @click="setLocale(loc)"
    >
      {{ loc.toUpperCase() }}
    </button>
  </div>
</template>
