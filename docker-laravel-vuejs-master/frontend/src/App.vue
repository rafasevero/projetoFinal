<template>
  <div>
    <header>
      <title>RRM</title>
    </header>
    <Login />
  </div>
</template>

<script>
import Login from './views/Login.vue'
export default{
  name:'App',
  components:{
    Login
  }
}
</script>