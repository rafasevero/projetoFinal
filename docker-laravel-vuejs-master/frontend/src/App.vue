<template>
    <main>
      <router-view />
    </main>
</template>

<script>

import HomeView from './views/HomeView.vue';

export default {
  name: 'App',
  components: {

    HomeView,

  }
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


</style>
