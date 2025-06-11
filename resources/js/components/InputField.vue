<script setup>
import { defineProps, defineEmits } from "vue";
import { useSlots } from "vue";

import ErrorMessages from "./ErrorMessages.vue";

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: false,
  },
  type: {
    type: String,
    default: "text",
  },
  placeholder: {
    type: String,
    default: "",
  },
  min: {
    type: String,
    default: null,
  },
  max: {
    type: String,
    default: null,
  },
  modelValue: {
    type: [String, Number],
    default: "",
  },
  icon: {
    type: String,
    default: null,
  },
  iconPosition: {
    type: String,
    default: "right",
  },
  isError: {
    type: Boolean,
    default: false,
  },
  errors: {
    type: Array,
    default: () => [],
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  isError: {
    type: Boolean,
    default: false,
  },
  errors: {
    type: Array,
    default: () => [],
  },
});

const slot = useSlots();

defineEmits(["update:modelValue", "blur", "onClickIcon"]);
</script>

<template>
  <div class="flex flex-col">
    <label v-if="props.label" :for="props.id" class="mb-2 text-base font-medium text-gray-700">
      {{ props.label }}
    </label>

    <div class="relative text-gray-500">
      <input
        class="w-full py-2 placeholder-gray-500 bg-gray-50 border border-gray-300 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-offset-2 rounded-md"
        :class="`${
          isError
            ? 'border-red-500 focus-visible:ring-red-500'
            : 'focus-visible:ring-blue-500'
        } 
        ${props.iconPosition === 'right' ? 'px-4' : 'pr-4 pl-12'}`"
        :id="props.id"
        :name="props.id"
        :type="props.type"
        :min="
          props.type === 'number' || props.type === 'date' ? props.min : null
        "
        :max="
          props.type === 'number' || props.type === 'date' ? props.max : null
        "
        :value="modelValue"
        :placeholder="props.placeholder"
        :disabled="props.disabled"
        @input="$emit('update:modelValue', $event.target.value)"
        @blur="$emit('blur', $event.target.value)"
      />

      <button
        v-if="props.icon || slot.icon"
        type="button"
        class="absolute top-1/2 -translate-y-1/2 inline-flex items-center justify-center cursor-pointer"
        :class="props.iconPosition === 'right' ? 'right-4' : 'left-4'"
        @click="$emit('onClickIcon', $event)"
      >
        <slot name="icon"></slot>
      </button>
    </div>

    <ErrorMessages v-if="isError" :errors="props.errors" class="mt-2" />
  </div>
</template>