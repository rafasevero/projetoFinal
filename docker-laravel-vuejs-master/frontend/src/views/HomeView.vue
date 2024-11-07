<template>
      <div>
        <Navbar />
    </div>
  <main>
      <Home />
      <Carrossel />
      <Article />
  </main>
  <div>
        <Footer />
    </div>
</template>

<script>
import Article from '@/components/Article.vue';
import Carrossel from '@/components/Carrossel.vue';
import Footer from '@/components/Footer.vue';
import Home from '@/components/Home.vue';
import Navbar from '@/components/Navbar.vue';

export default {
  name: 'HomeView',
  components: {
    Navbar,
    Home,
    Article,
    Carrossel,
    Footer,
    Navbar
  }
}
</script>