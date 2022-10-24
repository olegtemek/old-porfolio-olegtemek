<template>
  <div class="login">
    <div class="login__wrapper">
      <label for="">
        <span>Email</span>
        <p v-if="errors.email.error">{{ errors.email.message }}</p>
        <input type="email" v-model="data.email" placeholder="Email" />
      </label>
      <label for="">
        <span>Password</span>
        <p v-if="errors.password.error">{{ errors.password.message }}</p>
        <input
          type="password"
          @keyup.enter="login"
          v-model="data.password"
          placeholder="Password"
        />
      </label>

      <button class="btn" @click="login">Login</button>
    </div>
  </div>
</template>



<script setup>
import { useAuth } from "@/store/auth.js";
definePageMeta({
  layout: "admin",
});

const data = ref({
  email: null,
  password: null,
});
const errors = ref({
  email: {},
  password: {},
});
const store = useAuth();
const config = useRuntimeConfig();

const login = () => {
  // store.login(data)
  errors.value.email = {
    error: false,
  };
  errors.value.password = {
    error: false,
  };

  if (data.value.email == null) {
    errors.value.email = {
      error: true,
      message: "Email field is required",
    };
  }
  if (data.value.password == null) {
    errors.value.password = {
      error: true,
      message: "Password field is required",
    };
  }

  if (!errors.value.email.error && !errors.value.password.error) {
    store.login(data.value, config.public.api);
  }
};
</script>

<style lang="scss" scoped>
.login {
  width: 100%;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;

  &__wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 320px;
    padding: 20px;
    background: rgba($white, 0.2);
    border-radius: $br;
    border: 1px solid $white;
    backdrop-filter: blur(10px);
    box-shadow: 0px 0px 18px rgba($white, 0.25);

    label {
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: flex-start;
      margin-bottom: 40px;
      p {
        color: red;
        padding-bottom: 4px;
      }
      span {
        font-size: 20px;
        padding-bottom: 10px;
      }
      input {
        font-size: 18px;
        padding: 10px 20px;
        border-radius: $br;
      }
    }
    > button {
    }
  }
}
</style>