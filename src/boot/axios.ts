import { boot } from 'quasar/wrappers'
import axios from 'axios'

const api = axios.create({
  baseURL: 'http://100.96.189.80:8083/api',
  // baseURL: 'http://localhost/api',
  headers: {
    Accept: 'application/json'
  }
})

// 🔥 interceptor automático
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')

  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }

  return config
})

export default boot(({ app }) => {
  app.config.globalProperties.$api = api
})

export { api }