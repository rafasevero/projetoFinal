<template>
  <div>
    <header>
      <title>RRM</title>
    </header>
    <router-view></router-view>
  </div>
</template>

<script>
import { RouterView } from 'vue-router';
import LoginView from './views/LoginView.vue';
import RegisterView from './views/RegisterView.vue';

export default{
  name:'App',
  components:{
    LoginView,
    RegisterView
  }
}
</script>