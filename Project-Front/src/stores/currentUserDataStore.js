import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'

export const useCurrentUserDataStore = defineStore('CurrentUserDataStore', () => {
  const user = ref({})

  axios
    .get(`http://${localhost.value}/api/user/${localStorage.getItem('accessToken')}`)
    .then((res) => {
      user.value = res.data
    })

  return { user }
})
