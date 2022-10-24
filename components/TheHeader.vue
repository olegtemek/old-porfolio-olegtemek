<template>
  <div>
    <header class="header">
      <div class="container">
        <div class="header__wrapper">
          <h1>Hello world!</h1>
          <p>
            {{ description == "" ? "M" : description }}
          </p>
        </div>
      </div>
    </header>
  </div>
</template>

<script setup>
const text =
  "My name is Oleg. This portfolio was created on nuxt js on composition api front-end and can work with laravel api. Over time, this portfolio will change both in function and design.";
const description = ref("");
const typed = ref(true);
let index = 0;
const typedText = () => {
  description.value = text.substring(0, index);

  if (index++ != text.length) {
    setTimeout(() => {
      typedText();
    }, Math.floor(Math.random() * 220));
  } else {
    typed.value = false;
  }
};

typedText();
</script>


<style lang="scss" scoped>
.header {
  padding: 20px 0;
  &__wrapper {
    display: flex;
    align-items: center;
    flex-direction: column;

    h1 {
      font-size: 32px;
      font-weight: $fw-regular;
      padding-bottom: 20px;
    }
    p {
      font-size: 18px;
      position: relative;
      max-width: 860px;
    }
  }
}
</style>