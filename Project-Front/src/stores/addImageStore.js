import { ref } from 'vue'
import axios from 'axios'
import { defineStore } from 'pinia'
import localhost from '@/main'
import { useCurrentUserDataStore } from './currentUserDataStore'

export const useImageStore = defineStore({
  id: 'imageStore',

  state: () => ({
    uploadStatus: ref(''),
    file: ref(null),
    fileExists: ref(false),
    formData: ref({}),
    path: ref(''),
    imageName: ref(''),
    image: ref(''),
    store: useCurrentUserDataStore()
  }),

  actions: {
    uploadImage() {
      this.formData = new FormData()
      this.formData.append('image', this.file)
      this.formData.append('name', this.file['name'])
      this.imageName = this.file['name']
      axios
        .post(`http://${localhost.value}/api/uploadImage`, this.formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        })
        .then((res) => (this.path = res.data))
    },

    addImagePathToDB() {
      axios
        .get(`http://${localhost.value}/api/setImage/${this.path}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        })

        .then((res) => (this.path = res.data))
    },

    showUserAvatar() {
      axios
        .get(`http://${localhost.value}/api/tt`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        })
        .then((res) => (this.image = res.data))
    }
  }
})
