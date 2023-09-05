<template>
  <div id="app">
    <button @click="$router.push('/viewList')">Lista wiadomości</button>
    <button @click="$router.push('/viewAdd')">Dodaj wiadomość</button>
    <button @click="$router.push('/viewGet')">Odczytaj wiadomość</button>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  methods: {
    navigateTo(path) {
      this.$router.push(path);
    }
  }
}
</script>

<style>
/* Dodaj stylizację przycisków i głównego widoku */
</style>
