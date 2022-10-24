export const useImage = defineStore('image', {
  state: () => ({
    image: null,
  }),
  actions: {
    async fetchImage(url) {
      let res = await $fetch(url + 'api/get-image', {
        method: 'GET',
        headers: {
          'XSRF-TOKEN': useCookie('XSRF-TOKEN').value,
          'Accept': 'application/json, text/plain, */*',
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      this.image = res.image
    },

    async setImage(url, image) {
      let formData = new FormData();
      formData.append('image', image)
      let res = await $fetch(url + 'api/set-image', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${useCookie('token').value}`,
        },
        body: formData
      })
      if (res.status == 200) {
        this.image = res.image
      } else {
        alert('error')
      }
    }
  },
  getters: {
    getImage(state) {
      return state.image
    }
  }
})