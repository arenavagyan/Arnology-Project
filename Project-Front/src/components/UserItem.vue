<template>
  <div class="userCard">
    <h1>{{ props.name }}</h1>
    <p class="email">{{ props.email }}</p>
    <p class="role">{{ props.role }}</p>
    <p>{{ props.id }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  name: String,
  email: String,
  role: String,
  id: Number,
  activeUser: Object
})
</script>

<style scoped>
.userCard {
  width: 31rem;
  font-size: 0.8rem;
  padding: 0.5rem;
  border: 0.1rem solid gray;
}
.email {
  font-style: italic;
}
.role {
  color: rgb(235, 83, 83);
  font-size: 0.9rem;
}
</style>
