<template>
  <div class="admin__projects">
    <AdminModalComponent
      :type="type"
      :project="project"
      v-if="type"
      @close="closeModal"
    />
    <div class="admin__projects-wrapper">
      <h2>Projects</h2>
      <button @click="modal('create', null)">Create</button>

      <div class="admin__projects-table">
        <button
          class="admin__projects-table-item"
          v-for="project of projects"
          :key="project.id"
          @click="deleteProject(project.id)"
        >
          <img
            :src="config.public.api + 'storage/images/' + project.image"
            alt=""
          />
          <div class="admin__projects-table-item-right">
            <h3>{{ project.title }}</h3>
            <ul>
              <li
                v-for="(text, index) of JSON.parse(project.stack)"
                :key="index"
              >
                {{ text }}
              </li>
            </ul>
          </div>
        </button>
      </div>
    </div>
  </div>
</template>



<script setup>
import { useProjects } from "@/store/projects.js";
const store = useProjects();
const config = useRuntimeConfig();
const type = ref(null);
const project = ref(null);

onMounted(() => {
  store.fetchProjects(config.public.api);
});

const projects = computed(() => {
  return store.getProjects;
});
const modal = (ty, pr) => {
  project.value = pr;
  type.value = ty;
};
const closeModal = () => {
  type.value = null;
  project.value = null;
};

const deleteProject = (id) => {
  let result = confirm("You want delete project, are you sure?");
  if (!result) {
    return;
  }
  store.deleteProject(config.public.api, id);
};
</script>

<style lang="scss" scoped>
.admin__projects {
  overflow: hidden;
  box-shadow: 0px 1px 0px $white, 0px -1px 0px $white, 1px 0px 0px $white,
    -1px 0px 0px $white;
  border-radius: $br;

  &::after {
    border: none;
  }

  &-wrapper {
    display: flex;
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: column;
    overflow-y: scroll;
    height: 600px;
    h2 {
      font-size: 32px;
      font-weight: $fw-bold;
      padding-bottom: 20px;
    }

    > button {
      border: 1px solid $white;
      padding: 10px 20px;
      border-radius: $br;
      font-size: 20px;
      color: $white;
      transition: $tr;

      &:hover {
        background-color: $white;
        color: $black;
      }
    }
  }

  &-table {
    margin-top: 20px;
    padding-bottom: 60px;

    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;

    &-item {
      display: flex;
      align-items: flex-start;
      justify-content: flex-start;
      width: auto;
      padding: 20px;
      border-radius: $br;
      border: 1px solid $white;
      transition: $tr;
      color: $white;
      &:hover {
        border: 1px solid red;
      }
      img {
        width: 280px;
        height: 150px;
        object-fit: cover;
      }

      &-right {
        margin-left: 40px;
        h3 {
          font-size: 18px;
          padding-bottom: 8px;
          font-weight: $fw-bold;
          text-align: left;
        }
        ul {
          list-style: square;
          padding-left: 18px;
          width: 180px;
          display: flex;
          align-items: flex-start;
          justify-content: flex-start;
          flex-direction: column;
        }
      }
    }
  }
}
</style>