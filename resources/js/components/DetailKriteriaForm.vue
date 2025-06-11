<script setup>
import TextArea from "./TextArea.vue";
import UploadFile from "./Uploadfile.vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        default: "",
    },
    placeholder: {
        type: String,
        default: "",
    },
    supportingText: {
        type: String,
        default: "Pendukung",
    },
    acceptedFiles: {
        type: String,
        default: ".pdf,.doc,.docx,.png,.jpg,.jpeg",
    },
});

const emit = defineEmits(["update:description", "file-selected"]);

const handleDescriptionUpdate = (value) => {
    emit("update:description", value);
};

const handleFileSelected = (file) => {
    emit("file-selected", file);
};
</script>

<template>
    <fieldset class="p-4 pb-6 rounded-lg border border-gray-300 bg-white">
        <legend
            class="min-w-24 text-md text-white font-semibold ml-4 px-3 py-2 rounded bg-slate-900"
        >
            {{ title }}
        </legend>
        <div class="flex gap-4">
            <div class="w-full text-black">
                <TextArea
                    :model-value="description"
                    :placeholder="
                        placeholder ||
                        `Masukkan deskripsi ${title.toLowerCase()} di sini...`
                    "
                    @update:model-value="handleDescriptionUpdate"
                />
            </div>
            <div class="shrink-0 w-1/4">
                <p class="text-md font-semibold mb-2 text-[#021526]">
                    {{ supportingText }} {{ title }}
                </p>
                <UploadFile
                    @file-selected="handleFileSelected"
                    :accept="acceptedFiles"
                />
            </div>
        </div>
    </fieldset>
</template>
