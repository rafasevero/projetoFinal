<template>
    <div>
        <NavbarCandidate />
        <VacanciesUser />
        <Footer />
    </div>
</template>


<script>
import Footer from '@/components/Footer.vue';
import NavbarCandidate from '@/components/NavbarCandidate.vue';
import VacanciesUser from '@/components/VacanciesUser.vue';
export default {
    name: 'VacanciesUserView',
    components: {
        NavbarCandidate,
        VacanciesUser,
        Footer, 
    }   
}
</script>