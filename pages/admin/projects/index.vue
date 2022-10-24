<template>
  <div class="admin">
    <AdminHeaderComponent />
    <div class="admin__content">
      <AdminMenuComponent />
      <AdminProjectsComponent />
    </div>
  </div>
</template>



<script setup>
definePageMeta({
  layout: "admin",
  middleware: "is-auth",
  dashboard: true,
});
</script>

<style lang="scss">
.admin {
  width: 98%;
  height: 98vh;
  margin: 0 auto;
  > div {
    &:first-child {
      position: relative;
      &::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba($white, 0.2);
        border: 1px solid $white;
        backdrop-filter: blur(10px);
        border-radius: $br;
        box-shadow: 0px 0px 18px rgba($white, 0.25);
      }

      > div {
        position: relative;
        z-index: 2;
      }
    }
  }

  &__content {
    height: 600px;
    display: flex;
    justify-content: space-around;
    > div {
      width: 80%;
      position: relative;
      &::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba($white, 0.2);
        border: 1px solid $white;
        backdrop-filter: blur(10px);
        border-radius: $br;
        box-shadow: 0px 0px 18px rgba($white, 0.25);
      }
      &:first-child {
        width: 10% !important;
      }
      > div {
        position: relative;
        z-index: 2;
        padding: 40px;
      }
    }
  }
}
</style>