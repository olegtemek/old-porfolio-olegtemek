<template>
  <div>
    <div class="loading" v-show="loading">
      <div class="spin"></div>
    </div>
    <div class="loader" v-show="!loading">
      <TheHeader />
      <NuxtPage @loaded="isLoaded" />
      <TheFooter />
    </div>
  </div>
</template>

<script setup>
const loading = ref(true);
const isLoaded = () => {
  setTimeout(() => {
    loading.value = false;
  }, 500);
};
</script>

<style lang="scss" scoped>
.loading {
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  animation: anim 0.5s;
  .spin {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #6c11c0;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
  }
}
.loader {
  animation: anim 0.5s;
}
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes anim {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>