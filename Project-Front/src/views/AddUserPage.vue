<template>
  <div class="editPage">
    <h2>Create New User</h2>

    <form action="" method="post" class="card">
      <input type="text" placeholder="Write new name" ref="input1" v-model="store.name" />
      <input type="text" placeholder="Write email" v-model="store.email" />
      <input type="text" placeholder="Write email" v-model="store.password" />

      <button class="addUser" @click="store.addUser">Add</button>
      <a class="backLink" href="/admin/mainPage">Back To User list</a>
    </form>
  </div>
</template>

<script setup>
import { useRegistrationStore } from '@/stores/registerStore'
import { ref } from 'vue'

const input1 = ref(null)
const store = useRegistrationStore()
</script>

<style scoped>
h2 {
  font-family: Arial, Helvetica, sans-serif;
  font-weight: normal;
  text-align: center;
  margin-top: 5rem;
}
.editPage {
  display: flex;
  align-items: center;
  flex-direction: column;
  height: 100vh;
}
.card {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 2rem;
}
.form2 {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 0 2rem;
}
input {
  width: 15rem;
  padding: 0.4rem;
  height: 1rem;
  font-size: 1rem;
  margin: 0.5rem;
}
.addUser {
  margin-top: 1rem;
  width: 5rem;
  padding: 0.5rem;
  background-color: rgb(49, 141, 228);
  border: none;
  border-radius: 0.5rem;
  font-size: 1rem;
  color: white;
  cursor: pointer;
}
.backLink {
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  color: rgb(49, 141, 228);
  margin-top: 1rem;
  text-decoration: none ;
}
.checkOld {
  margin-top: 1rem;
  width: 10rem;
  padding: 0.5rem;
  background-color: rgb(49, 141, 228);
  border: none;
  border-radius: 0.5rem;
  font-size: 1rem;
  color: white;
  cursor: pointer;
}
.user_json {
  width: 400px;
}

.bi-check2-all {
  display: none;
}
</style>
