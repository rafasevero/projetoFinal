<template>
    <div>
        <Navbar />
    </div>
    <div>
        <RegisterEmpresa/>
    </div>
    <div>
        <Footer />
    </div>
</template>
<script>
import RegisterEmpresa from '@/components/RegisterEmpresa.vue'
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';
export default{
    name:'RegisterEmpresaView',
    components:{
        RegisterEmpresa,
        Footer,
        Navbar,
    }
}
</script>
