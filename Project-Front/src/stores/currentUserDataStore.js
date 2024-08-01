import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'

export const useCurrentUserDataStore = defineStore('CurrentUserDataStore', () => {
  const user = ref({})
  const token = ref(localStorage.getItem('authToken'))
  const avatarName = ref('')

  axios
  .get(`http://${localhost.value}/api/user`, {
    headers: {
      Authorization: `Bearer ${token.value}`
    }
  })
    .then((res) => {
      user.value = res.data.user
    })
    .catch(new Error ('unAuthorized'))

  return { user,avatarName }
})
