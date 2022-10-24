export default defineNuxtRouteMiddleware((to, from) => {
  const router = useRouter();

  const token = useCookie('token').value;
  if (!token) {
    return navigateTo('/login')
  }

  const config = useRuntimeConfig();

  const res = $fetch(config.public.api + 'api/check', {
    method: 'GET',
    headers: {
      'Accept': 'application/json, text/plain, */*',
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'Authorization': `Bearer ${token}`,
    }
  }).then(r => {
    if (r.status != 200) {
      return navigateTo('/login')
    }
  }).catch(e => {
    useCookie('token').value = null;
    return navigateTo('/login')
  })
})