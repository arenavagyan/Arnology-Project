import { ref } from 'vue'
import axios from 'axios'
import { defineStore } from 'pinia'
import localhost from '@/main'

export const useImageStore = defineStore({
  id: 'imageStore',

  state: () => ({
    uploadStatus: ref(''),
    file: ref(null),
    fileExists: ref(false),
    formData: ref({}),
    path: ref('')
  }),

  actions: {
    handleImageChange(e) {
      if (this.file) {
        this.file = e.target.files[0]
      }
    },
    uploadImage() {
      this.formData = new FormData()
      this.formData.append('image', this.file)
      axios
        .post(`http://${localhost.value}/api/uploadImage`, this.formData, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`,
            'Content-Type': 'multipart/form-data'
          }
        })
        .then((res) => (this.path = res.data))
    },

    addImagePathToDB() {
        
      axios
        .post(`http://${localhost.value}/api/setImage/${this.path}`, 
            
            {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('authToken')}`
          }
        })
        .then((res) => console.log(res.data))
    }
  }
})
