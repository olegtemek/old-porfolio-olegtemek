export const useProjects = defineStore('projects', {
  state: () => ({
    projects: null,
  }),
  actions: {
    async fetchProjects(url) {
      let res = await $fetch(url + 'api/projects', {
        method: "GET"
      });
      if (res.status == 200) {
        this.projects = res.projects
      }
    },
    async saveProject(url, image, stacks, title, link, id) {
      let formData = new FormData();
      formData.append('image', image)
      formData.append('title', title)
      formData.append('stacks', stacks)
      formData.append('link', link)
      formData.append('id', id)
      let res = await $fetch(url + 'api/save-project', {
        method: "POST",
        headers: {
          'Authorization': `Bearer ${useCookie('token').value}`
        },
        body: formData
      })

      if (res.status == 200) {
        this.projects = res.projects
      }
    },
    async deleteProject(url, id) {
      let res = await $fetch(url + 'api/delete-project', {
        method: "POST",
        headers: {
          'Authorization': `Bearer ${useCookie('token').value}`
        },
        body: {
          id: id
        }
      })

      if (res.status == 200) {
        this.projects = res.projects
      }
    }
  },

  getters: {
    getProjects(state) {
      return state.projects
    }
  }
})