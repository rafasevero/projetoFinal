<template>
    <div>
        <Navbar />
    </div>
    <div>
        <RecruiterRegister/>
    </div>
    <div>
        <Footer />
    </div>
</template>
<script>
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
import RecruiterRegister from '@/components/RecruiterRegister.vue';
export default{
    name:'RecruiterRegisterView',
    components:{
        RecruiterRegister,
        Footer,
        Navbar,
    }
}
</script>
