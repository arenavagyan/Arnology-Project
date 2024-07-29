import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
export const useUsersDataStore = defineStore('usersDataStore', () => {
  const users = ref([])
  const token = ref(localStorage.getItem('authToken'))

axios.get(`http://${localhost.value}/api/users`,{
  headers: {
    Authorization: `Bearer ${token.value}`
  }}
)
      .then((res) => { users.value = res.data }
    )
  return { users }
})
