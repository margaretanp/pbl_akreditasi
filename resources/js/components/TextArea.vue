<script setup>
import Editor from "@tinymce/tinymce-vue";
import { computed } from "vue";

const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },
});

const emit = defineEmits(["update:modelValue"]);

const editorValue = computed({
    get() {
        return props.modelValue || "Deskripsi";
    },
    set(value) {
        emit("update:modelValue", value);
    },
});

const handleEditorChange = (content) => {
    emit("update:modelValue", content);
};
</script>

<template>
    <main id="sample">
        <Editor
            :model-value="editorValue"
            @update:model-value="handleEditorChange"
            api-key="o24btjuj9h5mros43iyiym52cafzyoul9ahvnnabgvftimvn"
            :init="{
                // toolbar_mode: 'sliding',
                plugins: [
                    'anchor',
                    'autolink',
                    'charmap',
                    'codesample',
                    'image',
                    'link',
                    'lists',
                    'media',
                    'searchreplace',
                    'table',
                    'visualblocks',
                    'wordcount',
                ],
                toolbar:
                    'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
                setup: (editor) => {
                    editor.on('change keyup', () => {
                        const content = editor.getContent();
                        handleEditorChange(content);
                    });
                },
            }"
        />
    </main>
</template>
