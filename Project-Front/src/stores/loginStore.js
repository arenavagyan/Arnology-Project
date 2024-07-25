import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
import router from '@/router'
import { useAuthStore } from './authStore'

export const useLoginStore = defineStore('loginStore', () => {
  const store = useAuthStore()

  const email = ref('')
  const password = ref('')
  const status = ref('')
  const activeStatusId = ref(0)

  async function login(e) {
    e.preventDefault()

    try {
      const res = await axios.post(`http://${localhost.value}/api/login`, {
        email: email.value,
        password: password.value
      })

      activeStatusId.value = res.data['id']
      status.value = res.data['role']
      email.value = ''
      password.value = ''

      if (res.data['role'] === 'member') {
        store.setAuthenticated()
        await router.push('member/mainPage')
      }
      else if(res.data['role'] === 'admin'){
        store.setAuthenticated()
        await router.push('admin/mainPage')
      }
      else{
        alert("Incorrect ")
      }
    } catch (error) {
      console.error('Login Error:', error)
    }
  }

  async function getUserStatus() {
    return status.value
  }
  async function getUserId() {
    return activeStatusId.value
  }
  return { status, email, password, getUserId, login, getUserStatus }
})
