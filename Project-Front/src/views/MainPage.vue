<template>
  <h1 class="role">You are {{ status }}</h1>
  <a href="/editProfile" class="edit">Edit My Card</a>
  <div v-for="(user, index) in users" :key="index" class="userItem">
    <UserItem :name="user.name" :email="user.email" :role="user.role" :id="user.id" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useLoginStore } from '../stores/loginStore'
import { useUsersDataStore } from '../stores/usersDataStore'
import { storeToRefs } from 'pinia'
import UserItem from '../components/UserItem.vue'
import { useCurrentUserDataStore } from '@/stores/currentUserDataStore'
const userId = ref(0)

const store = useLoginStore()
const store2 = useUsersDataStore()
const store3 = useCurrentUserDataStore()

const { status, activeStatusId } = storeToRefs(store)
const { users } = storeToRefs(store2)
const {setCurrentUserId} = store3

async function getStatus() {
  await activeStatusId
  return activeStatusId
}

userId.value = getStatus()
setCurrentUserId
</script>

<style scoped>
.userItem {
  margin-top: 1rem;
}
.role {
  color: cornflowerblue;
  text-align: center;
}
.edit {
  color: white;
  text-decoration: none;
  box-shadow: 0.2rem 0.2rem 0.5rem rgb(221, 221, 221);
  padding: 0.8rem;
  background-color: cornflowerblue;
  border-radius: 0.5rem;
  margin-bottom: 5rem;
}
</style>
