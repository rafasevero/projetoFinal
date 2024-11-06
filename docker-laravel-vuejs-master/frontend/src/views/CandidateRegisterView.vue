<template>
    <div>
        <Navbar />
    </div>
    <div>
        <CandidateRegister/>
    </div>
    <div>
        <Footer />
    </div>
</template>
<script>
import CandidateRegister from '@/components/CandidateRegister.vue';
import Footer from '@/components/Footer.vue';
import Navbar from '@/components/Navbar.vue';

export default{
    name:'CandidateRegisterView',
    components:{
        CandidateRegister,
        Footer,
        Navbar,
    }

}
</script>
