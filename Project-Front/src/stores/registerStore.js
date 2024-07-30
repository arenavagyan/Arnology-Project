import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
import router from '@/router'
import { useUsersDataStore } from './usersDataStore'

export const useRegistrationStore = defineStore({
  id: 'registrationStore',

  state: () => ({
    name: ref(''),
    email: ref(''),
    password: ref(''),
    usersStore: useUsersDataStore()
  }),

  actions: {
    register(e) {
      e.preventDefault()

      axios
        .post(`http://${localhost.value}/api/register`, {
          name: this.name,
          email: this.email,
          password: this.password
        })
        .then(
          (this.name = ''),
          (this.email = ''),
          (this.password = ''),
          console.log('Done succesfully'),
          router.go(-1)
        )
    },
    addUser(e) {
      e.preventDefault()
      axios
        .post(
          `http://${localhost.value}/api/addUser`,
          {
            name: this.name,
            email: this.email,
            password: this.password
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('authToken')}`
            }
          }
        )
        .then((this.name = ''), (this.email = ''), (this.password = ''), alert('Done succesfully'))
    }
  }
})
