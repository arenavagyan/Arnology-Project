<template>
  <div class="userCard">
    <h1>{{ props.name }}</h1>
    <p class="email">{{ props.email }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  name: String,
  email: String,
  role: String,
  
})
</script>

<style scoped>
.userCard {
  width: 31rem;
  font-size: 0.8rem;
  padding: 0.5rem;
  border: 0.1rem solid gray;
  background-color: rgb(255, 157, 121);
}
.email {
  font-style: italic;
}
.role {
  color: rgb(235, 83, 83);
  font-size: 0.9rem;
}
</style>
