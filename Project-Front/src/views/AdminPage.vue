<template>
  <div class="main" ref="main">
    <h1 class="role">Users</h1>
    <button class="edit">
      <a href="/editProfile" class="editLink">Edit My Card</a>
    </button>
    <button class="edit">
      <a href="/" class="editLink">Logout</a>
    </button>
    <div v-for="(user, index) in store2.users" :key="index" class="userItem">
      <UserItemForAdmin
        v-if="user.role === 'member'"
        :name="user.name"
        :email="user.email"
        :role="user.role"
        :id="user.id"
        :activeUser="store.user"
      />
      <button v-if="user.role === 'member'" class="change" @click="open(user)">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="white"
          class="bi bi-pencil-square"
          viewBox="0 0 16 16"
        >
          <path
            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
          />
          <path
            fill-rule="evenodd"
            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"
          />
        </svg>
      </button>

      <div v-else></div>
    </div>

    <div class="changeWindow" ref="changeWindow">
      <div class="window">
        <div class="buttonDiv"><button class="button" @click="close">X</button></div>
        <div class="mainWindow">
          <h1>Edit Data</h1>
          <input type="text" v-model="changingUser.name" />
          <input type="text" v-model="changingUser.email" />
          <button class="acceptChanges" @click="edit">Accept Changes</button>
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
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useLoginStore } from '../stores/loginStore'
import { useUsersDataStore } from '../stores/usersDataStore'
import UserItemForAdmin from '@/components/UserItemForAdmin.vue'
import { useEditDataStore } from '@/stores/editDataStore'

const changeWindow = ref(null)
const main = ref(null)
const done = ref(null)

const changingUser = ref({})

const store = useLoginStore()
const store2 = useUsersDataStore()
const store3 = useEditDataStore()

function open(user) {
  changeWindow.value.style.display = 'flex'
  changingUser.value = user
}
function close() {
  changeWindow.value.style.display = 'none'
  done.value.style.display = 'none'
}
function edit() {
  store3.changeUserData(changingUser.value)
  done.value.style.display = 'block'
}
</script>

<style scoped>
.userItem {
  margin-bottom: 2rem;
  width: 35rem;

  border-radius: 1rem;
  display: flex;
  align-items: flex-end;
  box-shadow: 0px 0px 10px grey;
}
.role {
  color: cornflowerblue;
  text-align: center;
}
.edit {
  text-decoration: none;
  box-shadow: 0.2rem 0.2rem 0.5rem rgb(221, 221, 221);
  padding: 0.8rem;
  background-color: cornflowerblue;
  border-radius: 0.5rem;
  border: none;
  margin: 0 0.2rem 2rem 0;
}
.editLink {
  color: white;
  text-decoration: none;
}
.acceptChanges {
  color: white;
  text-decoration: none;
  box-shadow: 0.2rem 0.2rem 0.5rem rgb(221, 221, 221);
  padding: 0.8rem;
  background-color: cornflowerblue;
  border-radius: 0.5rem;
  margin-top: 2rem;
  margin-bottom: 2rem;
  border: none;
  font-size: 1.3rem;
  cursor: pointer;
}
.bi-check2-all {
  display: none;
}
.changeWindow {
  width: 100%;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.705);
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  justify-content: center;
  padding: 2rem;
}

.window {
  width: 90%;
  height: 90%;
  background-color: white;
  border-radius: 1rem;
}

.buttonDiv {
  display: flex;
  justify-content: flex-end;
  padding: 0.5rem;
}
.button {
  border: none;
  background-color: rgba(41, 41, 41, 0.568);
  padding: 0.5rem 1rem;
  font-size: 1.5rem;
  color: white;
  transition: 0.3s;
  border-radius: 0.5rem;
}
.button:hover {
  background-color: rgba(133, 133, 133, 0.568);
}

.change {
  padding: 1rem;
  height: 3rem;
  border: none;
  background-color: cornflowerblue;
  border-radius: 0.8rem;
  cursor: pointer;
  margin: 1rem;
}
.mainWindow {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.mainWindow input {
  width: 25%;
  padding: 0.5rem;
  font-size: 1rem;
  margin: 0.5rem;
}
</style>
