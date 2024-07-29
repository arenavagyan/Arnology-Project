import { ref } from 'vue'
import { defineStore } from 'pinia'
import localhost from '@/main'
import axios from 'axios'

export const useAuthStore = defineStore('authStore', () => {
  const isAuthenticated = ref(false)

  function setAuthenticated() {
    isAuthenticated.value = true
  }
  async function logout() {
    await axios
      .post(`http://${localhost.value}/api/logout`)
      .then((isAuthenticated.value = false), localStorage.removeItem('authToken'))
  }
  function isLoggedIn() {
    return isAuthenticated.value
  }

  return { isAuthenticated, setAuthenticated, logout, isLoggedIn }
})
