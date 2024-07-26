<template>
  <h1 class="role">Users</h1>
  <a href="/editProfile" class="edit">Edit My Card</a>
  <div v-for="(user, index) in store2.users" :key="index" class="userItem">
    <UserItem
      :name="user.name"
      :email="user.email"
      :role="user.role"
      :id="user.id"
      :activeUser="store.user"
    />
  </div>
</template>

<script setup>
import { useLoginStore } from '../stores/loginStore'
import { useUsersDataStore } from '../stores/usersDataStore'
import UserItem from '../components/UserItem.vue'

const store = useLoginStore()
const store2 = useUsersDataStore()
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
