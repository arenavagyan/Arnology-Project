<script setup></script>

<template>
  <main class="main">
    <h1 class="header">Login Page</h1>

    <form action="" method="post">
      <input type="text" name="name" id="" class="form_input" placeholder="Email" />
      <input type="password" name="" id="" class="form_input" placeholder="Password" />
      <button class="login">Login</button>
      <a href="/register" class="register">have not account yet</a>
    </form>
  </main>
</template>

<style scoped>
.main {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-self: center;
}
.header {
  text-align: center;
  font-family: Arial;
  font-size: 2rem;
  margin-top: 2rem;
}
form {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  flex-direction: column;
  border: 1px solid rgb(141, 141, 141);
  border-radius: 0.2rem;
  width: 25rem;
  padding: 2rem;
}
.form_input {
  width: 20rem;
  margin-top: 1rem;
  padding: 0.5rem;
}
.login {
  margin-top: 1rem;
  width: 5rem;
  padding: 0.5rem;
  background-color: rgb(49, 141, 228);
  border: none;
  border-radius: 0.5rem;
  font-size: 1rem;
  color: white;
}
.login:active {
  outline: none;
}

.register {
  color: rgb(54, 161, 255);
  text-decoration-line: none;
  margin-top: 0.5rem;
}
button {
  cursor: pointer;
}
</style>
