<template>
    <main>
        <Navbar/>
        <div>
            <Register />
        </div>
        <router-view/>
        <Footer/>
    </main>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
import Register from '@/components/Register.vue';
    export default{
        name:'RegisterView',
        components:{
            Register,
            Navbar,
            Footer
        }
    }
</script>