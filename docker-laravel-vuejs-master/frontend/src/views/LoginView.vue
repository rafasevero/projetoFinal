<template>
    <Navbar/>
    <div>
        <Login/>
    </div>
    <Footer/>
</template>
<script>
import Login from '@/components/Login.vue';
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
export default{
    name:'LoginView',
    components:{
        Login,
        Navbar,
        Footer
    }
}
</script>