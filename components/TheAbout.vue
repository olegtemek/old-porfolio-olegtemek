<template>
  <div class="about">
    <div class="container">
      <div class="about__wrapper">
        <img
          :src="config.public.api + 'storage/images/' + store.getImage"
          alt="me"
          v-if="store.getImage"
        />
        <div class="">
          <CardComponent
            :title="'About Me'"
            :text="`Hello, my name is Oleg, I am ${age} years old. My goal when
              working on a project is create a clear and functional product for
              ease of use and obtaining information to the clients that they
              will use daily`"
          >
          </CardComponent>
        </div>
      </div>
    </div>
  </div>
</template>



<script setup>
import { useImage } from "@/store/image.js";

const date = new Date();
const birth = new Date("September 6, 2002");
const config = useRuntimeConfig();
const store = useImage();

onMounted(() => {
  store.fetchImage(config.public.api);
});

let age = 20;
if (date.getDate() >= birth.getDate() && date.getMonth() >= birth.getMonth()) {
  age = date.getFullYear() - 2002;
} else {
  age = date.getFullYear() - 2003;
}
</script>


<style scoped lang="scss">
.about {
  &__wrapper {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 60px 0;
    @media (max-width: 600px) {
      padding: 20px 0;
    }
    img {
      width: 300px;
      height: 300px;
      border-radius: 50%;
      border: 1px solid $white;
      object-fit: cover;
      filter: grayscale(0.5);
      transition: $tr;

      @media (max-width: 870px) {
        width: 200px;
        height: 200px;
        display: none;
      }
      &:hover {
        filter: none;
      }
    }
  }
}
</style>