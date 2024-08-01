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

        .then((res) => {
          this.path = res.data
          if (res.data) {
            this.image = `http://${localhost.value}/api/images/${res.data}`,
            this.store.avatarName = `http://${localhost.value}/api/images/${res.data}`
          }
        })
    },

    showUserAvatar(refName) {
      axios
        .get(`http://${localhost.value}/api/currentUserImageName`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        })
        .then((res) => {
          if (res.data) {
            refName.value.src = `http://${localhost.value}/api/images/${res.data}`
          } else {
            refName.value.src = `../../public/defaultImage.png`
          }
        })
    }
  }
})
