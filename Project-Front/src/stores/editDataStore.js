import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'

export const useEditDataStore = defineStore({
  id: 'EditDataStore',

  state: () => ({
    name: ref(''),
    email: ref(''),
    id: ref(),
    oldPassword: ref(''),
    newPassword: ref(''),
    permission: ref(false)
  }),

  actions: {
    changeUserData(user) {
      axios.patch(`http://${localhost.value}/api/changeData/users/${this.id}`, {
        name: user.name,
        email: user.email,
        id: user.id
      })
    },
    checkOld(pass) {
      const apiUrl = `http://${localhost.value}/api/userPassword `

      const rawData = {
        password: pass
      }
      const config = {
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${localStorage.getItem('authToken')}`
        }
      }
      axios
        .post(apiUrl, rawData, config)
        .then((res) => {
          this.permission = res.data
          console.log(this.permission)
        })
        .catch((error) => {
          console.error(error)
        })
    },
    changeOldPassword(newUserPassword, id, refName) {
      axios
        .patch(
          `http://${localhost.value}/api/changePassword/users/${id}`,
          {
            newPassword: newUserPassword
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('authToken')}`
            }
          }
        )
        .then(console.log('changed successfully'), (refName.value.style.display = 'block'))
    },
    deleteUser(userId) {
      
      axios
        .delete(`http://${localhost.value}/api/delete/users/${userId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        })
        .catch(e => console.log(e))
    }
  }
})

