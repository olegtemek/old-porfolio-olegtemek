<template>
  <div
    class="card"
    ref="target"
    :style="{
      transform: cardTransform,
      transition: 'transform 0.25s ease-out',
    }"
  >
    <div
      class="card__inner"
      :style="props.blur == true ? 'filter: blur(2px)' : ''"
      v-if="props.title"
    >
      <h2>{{ props.title }}</h2>
      <p>{{ props.text }}</p>
    </div>
    <a
      :href="project.link"
      target="_blank"
      class="card__inner df"
      :style="props.blur == true ? 'filter: blur(2px)' : ''"
      v-else
    >
      <div class="card__project">
        <nuxt-img
          :src="config.public.api + 'storage/images/' + project.image"
          alt=""
          sizes="sm:220vw md:220px lg:410px"
          loading="lazy"
          format="webp"
        />
        <div class="card__project-text">
          <h4>{{ project.title }}</h4>
          <div>
            <ul>
              <li
                v-for="(text, index) of JSON.parse(project.stack)"
                :key="index"
              >
                {{ text }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>



<script setup>
import { useMouseInElement } from "@vueuse/core";
const target = ref(null);
const props = defineProps({
  title: {
    type: [String],
  },
  text: {
    type: [String],
  },
  project: {
    type: [Array, Object],
    default: null,
  },
  blur: {
    type: [Boolean],
    default: true,
  },
});

const { elementX, elementY, isOutside, elementHeight, elementWidth } =
  useMouseInElement(target);
const cardTransform = computed(() => {
  const MAX_ROTATION = 10;
  const rX = (
    MAX_ROTATION / 2 -
    (elementY.value / elementHeight.value) * MAX_ROTATION
  ).toFixed(2); // handles x-axis
  const rY = (
    (elementX.value / elementWidth.value) * MAX_ROTATION -
    MAX_ROTATION / 2
  ).toFixed(2); // handles y-axis
  return isOutside.value
    ? ""
    : `perspective(${elementWidth.value}px) rotateX(${rX}deg) rotateY(${rY}deg)`;
});

const config = useRuntimeConfig();
</script>

<style lang="scss" scooped>
.card {
  width: 480px;
  height: 240px;
  border-radius: $br;
  background: rgba($white, 0.2);
  border: 1px solid $white;
  backdrop-filter: blur(10px);
  box-shadow: 0px 0px 18px rgba($white, 0.25);
  border-radius: 20px;
  position: relative;

  @media (max-width: 1260px) {
    width: 400px;
    height: 200px;
  }
  @media (max-width: 620px) {
    width: 100%;
    height: auto;
  }
  &:hover {
    .card__inner {
      filter: none !important;
    }
  }
  &__inner {
    position: relative;
    z-index: 2;
    padding: 40px;
    transition: $tr;
    @media (max-width: 1260px) {
      padding: 20px;
    }
    &.df {
      display: flex;
    }
    h2 {
      font-size: 28px;
      font-weight: $fw-bold;
      padding-bottom: 10px;
    }
    p {
      font-size: 20px;
      line-height: 120%;
    }
  }

  &__project {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 100%;
    height: 100%;
    @media (max-width: 430px) {
      flex-direction: column;
      align-items: center;
    }
    img {
      margin-top: 10px;
      width: 270px;
      height: 145px;
      object-fit: cover;
      @media (max-width: 1260px) {
        width: 220px;
        height: 120px;
      }
      @media (max-width: 430px) {
        width: 100%;
        height: 100%;
      }
    }
    &-text {
      width: 114px;
      @media (max-width: 1260px) {
        width: 110px;
      }
      @media (max-width: 430px) {
        width: 100%;
        margin-top: 20px;
      }

      h4 {
        padding-bottom: 20px;
        font-size: 18px;
      }
      > div {
        padding-left: 20px;
        > ul {
          list-style: square;
          > li {
            margin-bottom: 8px;
            font-size: 18px;
          }
        }
      }
    }
  }
}
</style>