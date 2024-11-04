<template>
    <div>
        <NavbarCandidate />
        <main>
            <Vagas />
        </main>
        <Footer />
    </div>
</template>

<script>
import Footer from '@/components/Footer.vue';
import NavbarCandidate from '@/components/NavbarCandidate.vue';
import Vagas from '@/components/Vagas.vue';
    export default {
        name: 'UserPageView',
        components: {
            NavbarCandidate,
            Vagas,
            Footer,
        }
    }
</script>

<style> 
    
</style>