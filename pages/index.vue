<template>
  <div class="">
    <TheAbout />
    <TheProjects @loaded="isLoaded" />
  </div>
</template>

<script setup>
const emit = defineEmits(["loaded"]);
const isLoaded = () => {
  emit("loaded");
};
</script>


