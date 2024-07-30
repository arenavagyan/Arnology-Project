<template>
  <div class="main">
    <div class="image">
      <div class="imageRound" ref="imageRound" id="imageRound">
        <img src="../../public/defaultImage.png" alt="" class="userIcon" />
      </div>
      <input type="file" name="imageInput" ref="imageInputRef" @change="handleImageChange" />
      <button class="addImage" @click="uploadImage">Add Image</button>
    </div>
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
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useCurrentUserDataStore } from '../stores/currentUserDataStore'
import { useEditDataStore } from '../stores/editDataStore'
import { useImageStore } from '@/stores/addImageStore'

const input1 = ref(null)
const store = useCurrentUserDataStore()
const changeStore = useEditDataStore()
const imageStore = useImageStore()
const doneDataChange = ref(null)
const done = ref(null)
const file = ref(null)

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
  changeStore.changeOldPassword(changeStore.newPassword, store.user.id, done)
  done.value.style.display = 'block'
}

function handleImageChange(e) {
  file.value = e.target.files[0]
  if (file.value) {
    imageStore.file = file.value
    imageStore.fileExists = true
    imageStore.uploadImage()
  }
}

function uploadImage() {
  if (!imageStore.file) {
    alert('Please upload image')
  }

  imageStore.addImagePathToDB()

  
}
</script>

<style scoped>
.main {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-evenly;
}
.image {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 30%;
}
.imageRound {
  width: 20rem;
  height: 20rem;
  background-color: rgb(192, 192, 192);
  border: 0.3rem solid white;
  box-shadow: 0.1rem 0.1rem 1rem black;
  border-radius: 50%;
  margin-top: 5rem;
}
.addImage {
  text-decoration: none;
  box-shadow: 0.2rem 0.3rem 0.7rem rgb(58, 58, 58);
  padding: 0.7rem 1rem;
  background-color: rgb(49, 141, 228);
  color: white;
  border-radius: 0.5rem;
  border: none;
  margin-top: 1.5rem;
  cursor: pointer;
  transition: 0.7s;
}
.addImage:hover {
  box-shadow: 0 0.2rem 1rem rgb(58, 58, 58);
  background-color: rgb(4, 99, 187);
}
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
  width: 70%;
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
.userIcon {
  width: 100%;
  height: 100%;
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
  box-shadow: 0.2rem 0.3rem 0.7rem rgb(104, 103, 103);
  border: none;
  border-radius: 0.5rem;
  font-size: 0.9rem;
  color: white;
  cursor: pointer;
  transition: 0.7s;
}
.changeData:hover {
  background-color: rgb(23, 90, 153);
  box-shadow: 0.2rem 0.3rem 0.7rem rgb(31, 31, 31);
}
.checkOld {
  margin-top: 1rem;
  width: 10rem;
  padding: 0.5rem;
  background-color: rgb(49, 141, 228);
  box-shadow: 0.2rem 0.3rem 0.7rem rgb(90, 90, 90);
  border: none;
  border-radius: 0.5rem;
  font-size: 0.9rem;
  color: white;
  cursor: pointer;
  transition: 0.7s;
}
.checkOld:hover {
  background-color: rgb(10, 99, 182);
  box-shadow: 0.2rem 0.3rem 0.7rem rgb(20, 20, 20);
}
.user_json {
  width: 400px;
}

.bi-check2-all {
  display: none;
}
</style>
