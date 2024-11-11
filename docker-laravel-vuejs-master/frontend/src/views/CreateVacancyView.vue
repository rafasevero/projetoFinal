<template>
    <div>
        <NavbarRecruiter />
        <CreateVacancy />
        <Footer />
    </div>
</template>

<script>
import Footer from '@/components/Footer.vue';
import NavbarRecruiter from '@/components/NavbarRecruiter.vue'; 
import CreateVacancy from '@/components/CreateVacancy.vue';
    export default {
        name: 'CreateVacancyView',
        components: {
            NavbarRecruiter,
            CreateVacancy,
            Footer,
        }
    }
</script>