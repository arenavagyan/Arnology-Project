import { ref } from 'vue'
import axios from 'axios'
import localhost from '@/main'
import { defineStore } from 'pinia'
import { useLoginStore } from '../stores/loginStore'

export const useCurrentUserDataStore = defineStore('CurrentUserDataStore', () => {
  const user = ref([])
  const store = useLoginStore()
  const { getUserId } = store
  const id = getUserId
 function setCurrentUserId(){
  axios.get(`http://${localhost.value}/api/users/${id.value}`).then((res) => {
    user.value = res.data
    console.log(user.value)
  })}

  return { user,setCurrentUserId }
})
