import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
export const useRegistrationStore = defineStore('registrationStore', () => {
  const name = ref('')
  const email = ref('')
  const password = ref('')

  function register() {
    axios.post(`http://${localhost.value}/api/register`,{
        name:name.value,
        email:email.value,
        password:password.value
    })
  }

  return { name,register }
})
