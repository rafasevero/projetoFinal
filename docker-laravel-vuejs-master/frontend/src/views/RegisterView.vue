<template>
    <Navbar/>
    <div>
        <Register/>
    </div>
    <div>
        <Footer/>
    </div>
</template>
<script>
import Register from '@/components/Register.vue'
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
export default{
    name:'RegisterView',
    components:{
        Register,
        Footer,
        Navbar,
    }
}
</script>
