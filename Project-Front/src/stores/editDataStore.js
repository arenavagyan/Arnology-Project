import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'

export const useEditDataStore = defineStore({
  id: 'EditDataStore',

  state: () => ({
    name: ref(''),
    email: ref(''),
    id: ref()
  }),

  actions: {
    changeUserData(user) {
      axios.patch(`http://${localhost.value}/api/changeData/users/${this.id}`, {
        name: user.name,
        email: user.email,
        id: user.id
      })
    }
  }
})
