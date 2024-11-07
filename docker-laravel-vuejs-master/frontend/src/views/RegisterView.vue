<template>
    <div>
        <Navbar />
    </div>
    <div>
        <Register />
    </div>
    <div>
        <Footer />
    </div>
</template>

<script>
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
import Register from '@/components/Register.vue'
export default{
    name:'RegisterView',
    components:{
        Register,
        Navbar,
        Footer,
    }
}
</script>