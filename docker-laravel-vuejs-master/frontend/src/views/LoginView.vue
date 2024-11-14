<template>
    <div>
        <Navbar />
    </div>
    <div>
        <Login/>
    </div>
    <div>
        <Footer />
    </div>
</template>
<script>
import Footer from '@/components/Footer.vue';
import Login from '@/components/Login.vue';
import Navbar from '@/components/Navbar.vue';
export default{
    name:'LoginView',
    components:{
        Login,
        Navbar,
        Footer
    }
}
</script>