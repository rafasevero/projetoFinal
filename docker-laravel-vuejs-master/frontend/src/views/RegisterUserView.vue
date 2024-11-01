<template>
    <Navbar/>
    <div>
        <RegisterUser/>
    </div>
    <div>
        <Footer/>
    </div>
</template>
<script>

import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
import RegisterUser from '@/components/RegisterUser.vue';
export default{
    name:'RegisterUserView',
    components:{
        RegisterUser,
        Footer,
        Navbar,
    }
}
</script>
