import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('authStore', () => {
  const isAuthenticated = ref(false)

  function setAuthenticated() {
    isAuthenticated.value = true
  }
  function logout() {
    isAuthenticated.value = false
  }
  function isLoggedIn() {
    return localStorage.getItem('accessToken')
    //axios.request
  }

  return { isAuthenticated, setAuthenticated, logout, isLoggedIn }
})
