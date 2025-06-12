<script setup>
import { computed } from "vue";

const prop = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:show"]);

const isOpen = computed({
  get: () => prop.show,
  set: (value) => emit("update:show", value),
});

const openModal = () => {
  isOpen.value = true;
};

const closeModal = () => {
  isOpen.value = false;
};

const onConfirm = () => {
  closeModal();
};

const stopPropagation = (event) => {
  event.stopPropagation();
};

defineExpose({
  openModal,
  closeModal,
});
</script>

<template>
  <div v-if="isOpen" class="relative z-50">
    <div @click="closeModal" class="fixed inset-0 bg-black/25">
      <div
        class="flex flex-col items-center justify-center w-full h-screen overflow-y-auto"
      >
        <div
          @click="stopPropagation"
          class="w-full max-w-md rounded-lg shadow-lg text-gray-700 bg-white [&_hr]:text-gray-300"
        >
          <div class="px-4 py-3 text-xl font-bold">
            <slot name="header">Modal Dialog Header</slot>
          </div>

          <hr />

          <div class="px-4 py-3 text-base text-gray-500">
            <slot name="body">Content goes here</slot>
          </div>

          <hr />

          <div
            class="px-4 py-3 text-base font-semibold flex items-center justify-end gap-x-4"
          >
            <slot name="footer">
              <button @click="closeModal">Close</button>
              <button @click="onConfirm" class="text-blue-500">Ok</button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>