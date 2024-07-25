import { ref } from 'vue';
import axios from 'axios';
import localhost from '@/main';
import { defineStore } from 'pinia';
import router from '@/router';
import { useAuthStore } from './authStore';

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
    async login(e) {
      e.preventDefault();

      try {
        const res = await axios.post(`http://${localhost.value}/api/login`, {
          email: this.email,
          password: this.password
        });

        this.id = res.data.id;
        this.status = res.data.role;
        this.email = '';
        this.password = '';
        this.user = res.data;

        console.log(this.user); 

        if (res.data.role === 'member') {
          useAuthStore().setAuthenticated();
          await router.push('member/mainPage');
        } else if (res.data.role === 'admin') {
          useAuthStore().setAuthenticated();
          await router.push('admin/mainPage');
        } else {
          alert('Incorrect role');
        }
      } catch (error) {
        console.error('Login Error:', error);
      }
    },

    async getUserStatus() {
      return this.status;
    }
  }
});
