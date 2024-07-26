<template>
  <div class="userCard" v-if="props.role === 'member'">
    <h1>{{ props.name }}</h1>
    <p class="email">{{ props.email }}</p>
    <div class="id_change">
      <p class="id">{{ props.id }}</p>
      
    </div>
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
}
.email {
  font-style: italic;
}
.role {
  color: rgb(146, 14, 14);
  font-size: 0.9rem;
}

.id {
  font-size: 1rem;
  font-weight: bold;
}
.id_change {
  display: flex;
  justify-content: space-between;
}
</style>
