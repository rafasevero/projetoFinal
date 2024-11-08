<template>
    <div>
        <NavbarCandidate />
        <main>
            <VacanciesUser/>
        </main>
        <Footer />
    </div>
</template>

<script>
import Footer from '@/components/Footer.vue';
import NavbarCandidate from '@/components/NavbarCandidate.vue';
import VacanciesUser from '@/components/VacanciesUser.vue';
    export default {
        name: 'UserPageView',
        components: {
            NavbarCandidate,
            VacanciesUser,
            Footer,
        }
    }
</script>

<style> 
    
</style>