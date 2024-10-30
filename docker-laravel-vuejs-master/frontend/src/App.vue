
<template>
    <div class="wrapper">
      <nav>
        <Navbar />
      </nav>
    </div>
    <main>
      <router-view />
    </main>
    <Footer />
</template>

<script>
import Footer from './components/Footer.vue';
import Navbar from './components/Navbar.vue'
import HomeView from './views/HomeView.vue';

export default {
  name: 'App',
  components: {
    Navbar,
    HomeView,
    Footer,
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
