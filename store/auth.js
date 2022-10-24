export const useAuth = defineStore('auth', {
  actions: {
    async login(data, url) {

      const tokenResponse = await $fetch(url + 'api/csrf-cookie', {
        method: 'GET',
        credentials: 'include'
      })

      const token = useCookie('XSRF-TOKEN').value
      const loginResponse = await $fetch(url + 'api/login', {
        method: 'POST',
        credentials: 'include',
        headers: {
          'XSRF-TOKEN': token,
          'Accept': 'application/json, text/plain, */*',
          'Content-Type': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: {
          email: data.email,
          password: data.password
        }
      }).then(async (r) => {
        if (r.status == '200') {
          const cookie = useCookie('token')
          cookie.value = r.token
          const router = useRouter();
          router.push({ path: '/admin' })
        } else if (r.status == '400') {
          alert(r.data)
        } else {
          alert('error, try again in while 5 min')
        }
      })
    },
  }
})