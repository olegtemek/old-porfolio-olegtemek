<template>
  <div class="admin__image">
    <div class="admin__image-wrapper">
      <h2>Current image</h2>
      <img
        :src="config.public.api + 'storage/images/' + store.getImage"
        alt=""
        v-if="image == null"
      />
      <img :src="image" alt="" v-else />
      <label for="imagePick">
        <p>Choose new image</p>
        <input
          id="imagePick"
          type="file"
          accept="image/png, image/jpg, image/jpeg"
          @change="pick"
        />
      </label>
    </div>
  </div>
</template>



<script setup>
import { useImage } from "@/store/image.js";
const image = ref(null);
const store = useImage();
const config = useRuntimeConfig();
const pick = (e) => {
  const file = e.target.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = (event) => {
      image.value = event.target.result;
    };
    reader.readAsDataURL(file);
    store.setImage(config.public.api, file);
  }
};

onMounted(() => {
  store.fetchImage(config.public.api);
});
</script>


<style lang="scss" scoped>
.admin__image {
  &-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    h2 {
      font-size: 24px;
      padding-bottom: 20px;
      font-weight: $fw-bold;
    }
    img {
      width: 300px;
      height: 300px;
      border-radius: 50%;
      border: 1px solid $white;
      object-fit: cover;
      filter: grayscale(0.5);
      transition: $tr;
      &:hover {
        filter: none;
      }
    }

    label {
      padding-top: 40px;
      cursor: pointer;
      p {
        padding-bottom: 10px;
        font-size: 18px;
        padding: 10px 20px;
        border-radius: $br;
        border: 1px solid $white;
        transition: $tr;
        &:hover {
          background-color: $white;
          color: $black;
          font-weight: $fw-bold;
        }
      }
      input {
        display: none;
      }
    }
  }
}
</style>