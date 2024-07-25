import { ref } from 'vue';
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia';
import router from '@/router';
export const useRegistrationStore = defineStore('registrationStore', () => {
  const name = ref('')
  const email = ref('')
  const password = ref('')

  function register(e) {
    e.preventDefault()
   
   axios.post(`http://${localhost.value}/api/register`,{
        name:name.value,
        email:email.value,
        password:password.value
    })
    .then(
      name.value = '',
      email.value = '',
      password.value = '',
      console.log("Done succesfully"),
      router.go(-1))

  }

  return { name,email,password,register }
})
