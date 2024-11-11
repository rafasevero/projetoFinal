<template>
    <div>
        <NavbarRecruiter />
        <VacanciesRecruiter />
        <Footer />
    </div>
</template>


<script>
import Footer from '@/components/Footer.vue';
import NavbarRecruiter from '@/components/NavbarRecruiter.vue';
import VacanciesRecruiter from '@/components/VacanciesRecruiter.vue';
export default {
    name: 'VacanciesView',
    components: {
        NavbarRecruiter,
        VacanciesRecruiter,
        Footer, 
    }   
}
</script>