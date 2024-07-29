<template>
  <div class="editPage">
    <h2>Change Data</h2>

    <form action="" method="post" class="card">
      <input type="text" placeholder="Write new name" ref="input1" v-model="store.user.name" />
      <input type="text" placeholder="Write email" v-model="store.user.email" />

      <button class="changeData" @click="changeData">Change</button>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="50"
        height="50"
        fill="green"
        class="bi bi-check2-all"
        viewBox="0 0 16 16"
        ref="doneDataChange"
      >
        <path
          d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"
        />
        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
      </svg>
    </form>
    <h2>Change Password</h2>
    <form action="" class="form2">
      <input
        type="text"
        name="oldPassword"
        id=""
        placeholder="Old password"
        v-model="changeStore.oldPassword"
        @change="checkOld"
      />
      <input
        type="text"
        name="newPassword"
        id=""
        placeholder="New password"
        v-model="changeStore.newPassword"
      />
      <button class="checkOld" @click="changePassword">Change Password</button>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="50"
        height="50"
        fill="green"
        class="bi bi-check2-all"
        viewBox="0 0 16 16"
        ref="done"
      >
        <path
          d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0"
        />
        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
      </svg>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useCurrentUserDataStore } from '../stores/currentUserDataStore'
import { useEditDataStore } from '../stores/editDataStore'

const input1 = ref(null)
const store = useCurrentUserDataStore()
const changeStore = useEditDataStore()
const doneDataChange = ref(null)
const done = ref(null)

function changeData(e) {
  e.preventDefault()
  changeStore.changeUserData(store.user)
  doneDataChange.value.style.display = 'block'
}

function checkOld(e) {
  e.preventDefault()
  if (changeStore.permission) {
    console.log(changeStore.newPassword)
    
  }
}

function changePassword(e) {
  e.preventDefault()
  changeStore.changeOldPassword(changeStore.newPassword, store.user.id,done)
  done.value.style.display = 'block'
  
}
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
.changeData {
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
