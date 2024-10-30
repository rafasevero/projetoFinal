<template>
  <div>
    <header>
      <title>RRM</title>
    </header>
    <LoginView />
  </div>
</template>

<script>
import LoginView from './views/LoginView.vue';

export default{
  name:'App',
  components:{
    LoginView
  }
}
</script>