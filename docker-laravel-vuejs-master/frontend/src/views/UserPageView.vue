<template>
    <div>
        <NavbarCandidato />
        <main>
            <Vagas />
        </main>
        <Footer />
    </div>
</template>

<script>
import Footer from '@/components/Footer.vue';
import NavbarCandidato from '@/components/NavbarCandidato.vue';
import Vagas from '@/components/Vagas.vue';
    export default {
        name: 'UserPageView',
        components: {
            NavbarCandidato,
            Vagas,
            Footer,
        }
    }
</script>

<style> 
    
</style>