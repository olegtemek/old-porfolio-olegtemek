<template>
  <div class="modal" :class="props.type ? 'active' : ''" v-if="type">
    <div class="modal__wrapper" ref="target">
      <label for="image" class="image">
        <img :src="image" alt="" v-if="image" />
        <img src="@/assets/img/img_not.png" alt="" v-else />
        <input
          type="file"
          id="image"
          accept="image/png, image/jpg, image/jpeg"
          @change="pick"
        />
      </label>
      <label>
        <p>Title</p>
        <input type="text" placeholder="Choose title" v-model="title" />
      </label>
      <label>
        <p>Link</p>
        <input type="text" placeholder="Choose link" v-model="link" />
      </label>

      <label>
        <p>U can add stack</p>
        <button @click="increment"></button>
      </label>

      <label v-for="index of add" :key="index">
        <p>{{ index }}. Stack</p>
        <input
          type="text"
          class="input__created"
          :placeholder="index + ' Stack'"
        />
      </label>

      <button @click="save">Save</button>
    </div>
  </div>
</template>



<script setup>
import { onClickOutside } from "@vueuse/core";
import { useProjects } from "@/store/projects.js";
const target = ref(null);
const emit = defineEmits(["close"]);
onClickOutside(target, (event) => emit("close", true));
const add = ref(1);
const store = useProjects();
const config = useRuntimeConfig();
const title = ref(null);
const stacks = ref([]);
const link = ref(null);
const image = ref(null);
let imageData = null;
const props = defineProps({
  type: {
    type: String,
    default: null,
  },
});

const increment = () => {
  if (add.value <= 2) {
    add.value++;
  }
};

const pick = (e) => {
  const file = e.target.files[0];
  if (file) {
    let reader = new FileReader();
    reader.onload = (event) => {
      image.value = event.target.result;
    };
    reader.readAsDataURL(file);
    image.value = file;
    imageData = file;
  }
};

const save = () => {
  let inputs = document.querySelectorAll(".input__created");
  let stacks = [];
  inputs.forEach((input) => {
    if (input.value) {
      stacks.push(input.value);
    }
  });
  store.saveProject(
    config.public.api,
    imageData,
    stacks,
    title.value,
    link.value
  );
  emit("close", true);
};
</script>

<style lang="scss" scoped>
.modal {
  color: $white;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  position: fixed;
  z-index: 3;
  align-items: center;
  justify-content: center;

  display: none;

  &.active {
    display: flex;
  }

  &::after {
    content: "";
    background-color: $black;
    opacity: 0.8;
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
  }

  &__wrapper {
    position: relative;
    z-index: 2;
    width: 800px;
    border-radius: $br;
    background: rgba($white, 0.2);
    border: 1px solid $white;
    backdrop-filter: blur(10px);
    box-shadow: 0px 0px 18px rgba($white, 0.25);
    padding: 20px;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    img {
      width: 300px;
      height: 200px;
      object-fit: cover;
    }

    > label {
      margin-top: 20px;
      width: 300px;
      text-align: left;

      > input[type="file"] {
        display: none;
      }

      &.image {
        cursor: pointer;
      }

      p {
        font-size: 18px;
        font-weight: $fw-bold;
        padding-bottom: 4px;
      }
      input {
        padding: 10px 20px;
        border-radius: $br;
        background-color: $white;
        font-size: 16px;
        width: 100%;
        box-sizing: border-box;
      }

      button {
        color: $black;
        background-color: $white;
        padding: 20px;
        border-radius: $br;
        border: 1px solid $green;
        position: relative;
        transition: $tr;

        &:hover {
          background-color: $black;
          &::after {
            color: $white;
          }
        }
        &::after {
          content: "+";
          position: absolute;
          transition: $tr;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          font-size: 40px;
        }
      }
    }
    > button {
      margin-top: 20px;
      color: $white;
      border: 1px solid $white;
      padding: 10px 20px;
      border-radius: $br;
    }
  }
}
</style>