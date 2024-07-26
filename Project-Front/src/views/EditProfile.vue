<template>
  <div class="editPage">
    <form action="" method="post" class="card">
      <input
        type="text"
        placeholder="Write new name"
        class="name"
        ref="input1"
        v-model="store.user.name"
      />
      <input type="text" placeholder="Write email" v-model="store.user.email" />

      <button class="change" @click="changeData">Change</button>
    </form>
    <p class="user_json">{{ store.user }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useCurrentUserDataStore } from '../stores/currentUserDataStore'
import { useEditDataStore } from '../stores/editDataStore'

const input1 = ref(null)
const store = useCurrentUserDataStore()
const changeStore = useEditDataStore()

function changeData(e){
  e.preventDefault();
  
changeStore.changeUserData({
  name:store.user.name,
  email:store.user.email,
  id:store.user.id
})}

/* store.setCurrentUserId() */
</script>

<style scoped>
.editPage {
  display: flex;
  justify-content: center;
}
.card {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin: 2rem;
}
input {
  width: 15rem;
  padding: 0.4rem;
  height: 1rem;
  font-size: 1rem;
  margin: 0.5rem;
}
.change {
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
.user_json {
  width: 400px;
}
</style>
