<script setup>
  import Editor from '@tinymce/tinymce-vue'
</script>

<template>
  <main id="sample">
    <Editor
      api-key="yt2b4ctygrrbqnnkg3wx5qgmpn0jbl6yy8hg2uj3tm292bzk"
      :init="{
        toolbar_mode: 'sliding',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      }"
      initial-value="Welcome to TinyMCE!"
    />
  </main>
</template>