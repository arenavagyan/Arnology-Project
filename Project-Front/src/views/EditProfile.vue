<template>
  <div class="editPage">
    <form action="" method="post" class="card">
      <input type="text" placeholder="Write new name" :value="store.name" />
      <input type="text" placeholder="Write email" />
      <input type="text" placeholder="Write password" />

      <button class="change">Change</button>
    </form>
    <p>{{ store.id }}</p>
  </div>
</template>

<script setup>
import { useCurrentUserDataStore } from '../stores/currentUserDataStore'

const store = useCurrentUserDataStore()

store.setCurrentUserId()
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
}
</style>
