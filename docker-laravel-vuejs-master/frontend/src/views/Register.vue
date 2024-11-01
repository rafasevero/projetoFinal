<template>
    <main>
        <Navbar/>
        <div>

        </div>
        <router-view/>
        <Footer/>
    </main>
</template>
<script>
import Navbar from '@/components/Navbar.vue';
import Footer from '@/components/Footer.vue';
    export default{
        name:Register,
        components:{
            Navbar,
            Footer
        }
    }
</script>