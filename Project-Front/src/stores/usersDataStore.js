import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
export const useUsersDataStore = defineStore('usersDataStore', () => {
  const users = ref([])

axios.get(`http://${localhost.value}/api/users`)
      .then((res) => { users.value = res.data }
    )
  return { users }
})
