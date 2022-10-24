<template>
  <div class="projects">
    <div class="container">
      <h2 class="title">My Projects</h2>
      <div class="projects__wrapper">
        <CardComponent
          :project="project"
          :blur="false"
          v-for="project of projects"
          :key="project.id"
        />
      </div>

      <a href="https://github.com/olegtemek/" target="_blank" class="btn"
        >See more</a
      >
    </div>
  </div>
</template>



<script setup>
import { useProjects } from "@/store/projects.js";
const store = useProjects();
const config = useRuntimeConfig();
onMounted(() => {
  store.fetchProjects(config.public.api);
});

const projects = computed(() => {
  return store.getProjects;
});
</script>

<style lang="scss" scoped>
.projects {
  text-align: center;
  padding-bottom: 80px;
  @media (max-width: 600px) {
    padding-bottom: 40px;
  }
  &__wrapper {
    text-align: left;
    display: flex;
    flex: 0 50%;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 60px 0;
    padding-bottom: 78px;

    @media (max-width: 600px) {
      padding-bottom: 40px;
    }

    @media (max-width: 1280px) {
      gap: 20px 0;
    }
    @media (max-width: 1260px) {
      justify-content: center;
      gap: 20px;
    }

    > div {
      cursor: pointer;
    }
  }
}
</style>