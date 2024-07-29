import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
import router from '@/router'
import { useAuthStore } from './authStore'

export const useLoginStore = defineStore({
  id: 'loginStore',

  state: () => ({
    email: ref(''),
    password: ref(''),
    status: ref(''),
    id: ref(0),
    user: ref({})
  }),

  actions: {
    login(e) {
      e.preventDefault()

      axios
        .post(`http://${localhost.value}/api/login`, {
          email: this.email,
          password: this.password
        })
        .then((res) => {
          localStorage.setItem('authToken', res.data)
          axios
            .get(`http://${localhost.value}/api/user`, {
              headers: {
                Authorization: `Bearer ${res.data}`
              }
            })
            .then((res) => {
              this.id = res.data.user.id
              this.status = res.data.user.role
              this.email = ''
              this.password = ''
              this.user = res.data.user

              if (res.data.user.role === 'member') {
                useAuthStore().setAuthenticated()
                router.push('member/mainPage')
              } else if (res.data.user.role === 'admin') {
                useAuthStore().setAuthenticated()
                router.push('admin/mainPage')
              } else {
                alert('Incorrect role')
              }
            })
        })
    }
  },

  async getUserStatus() {
    return this.status
  }
})
