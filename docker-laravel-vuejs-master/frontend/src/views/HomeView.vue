<template>
  <main>
      <Home />
      <Carrossel />
      <Article />
  </main>
</template>

<script>
import Article from '@/components/Article.vue';
import Carrossel from '@/components/Carrossel.vue';
import Home from '@/components/Home.vue';

export default {
  name: 'HomeView',
  components: {
    Home,
    Article,
    Carrossel
  }
}
</script>