<template>
  <div class="admin__menu">
    <div class="admin__menu-wrapper">
      <NuxtLink to="/admin/image" class="admin__menu-item">Image</NuxtLink>
      <NuxtLink to="/admin/projects" class="admin__menu-item"
        >Projects</NuxtLink
      >
    </div>
  </div>
</template>



<script setup>
</script>

<style lang="scss" scoped>
.admin__menu {
  &-wrapper {
    padding: 20px;
  }
  &-item {
    display: block;
    width: 100%;
    border: 1px solid $white;
    border-radius: $br;
    padding: 20px;
    box-sizing: border-box;
    margin-bottom: 40px;
    font-size: 20px;
    &:last-child {
      margin-bottom: 0;
    }

    &.router-link-active {
      border: 1px solid $green;
      color: $green;
      font-weight: $fw-bold;
    }
  }
}
</style>