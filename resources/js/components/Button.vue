<script setup>
import { computed, useSlots } from "vue";

const props = defineProps({
    label: {
        type: String,
        default: "Button",
    },
    type: {
        type: String,
        default: "button",
    },
    size: {
        type: String,
        default: "normal",
    },
    variant: {
        type: String,
        default: "primary",
    },
    justify: {
        type: String,
        default: "center",
    },
    icon: {
        type: String,
        default: null,
    },
    iconPosition: {
        type: String,
        default: "right",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    onclick: {
        type: Function,
        default: null,
    },
});

const slot = useSlots();

const buttonClasses = computed(() => {
    const sizeClasses = {
        small: "px-2 py-1 text-sm",
        normal: "px-4 py-2 text-base",
        large: "px-6 py-3 text-lg",
    };

    const variantClasses = {
        primaryFilled: "bg-slate-800 hover:bg-slate-900 text-white",
        dangerFilled: "bg-red-500 hover:bg-red-600 text-white",
        successFilled: "bg-green-500 hover:bg-green-600 text-white",
        primaryOutlined:
            "bg-white hover:bg-slate-100 border border-slate-800 text-slate-800",
        dangerOutlined:
            "bg-white hover:bg-red-50 border border-red-500 text-red-500",
        successOutlined:
            "bg-white hover:bg-green-50 border border-green-500 text-green-500",
    };

    const justifyClasses = {
        start: "justify-start",
        center: "justify-center",
        end: "justify-end",
        between: "justify-between",
    };

    const sizeClass = sizeClasses[props.size] || sizeClasses.normal;
    const variantClass =
        variantClasses[props.variant] || variantClasses.primaryFilled;
    const justifyClass = justifyClasses[props.justify] || justifyClasses.center;
    const hasIcon = props.icon || slot.icon;
    const flexDirection = hasIcon
        ? props.iconPosition === "left"
            ? "flex-row"
            : "flex-row-reverse"
        : "flex-row"; // Default to flex-row when no icon

    return `font-medium inline-flex items-center focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-offset-2 rounded-md ${sizeClass} ${variantClass} ${
        props.disabled ? "opacity-50 cursor-not-allowed" : "cursor-pointer"
    } ${flexDirection} ${justifyClass}`;
});
</script>

<template>
    <button
        :type="props.type"
        :class="buttonClasses"
        :disabled="props.disabled"
        @click="props.onclick"
    >
        <div v-if="props.icon || slot.icon">
            <slot name="icon"></slot>
        </div>
        <slot>{{ props.label }}</slot>
    </button>
</template>
