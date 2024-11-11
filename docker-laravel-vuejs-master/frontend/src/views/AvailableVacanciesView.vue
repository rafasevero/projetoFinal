
<template>
    <div>
        <NavbarRecruiter />
        <AvailableVacancies />
        <Footer />
    </div>
</template>


<script>
import Footer from '@/components/Footer.vue';
import NavbarRecruiter from '@/components/NavbarRecruiter.vue';
import AvailableVacancies from '@/components/AvailableVacancies.vue';
export default {
    name: 'AvailableVacanciesView',
    components: {
        NavbarRecruiter,
        AvailableVacancies,
        Footer, 
    }   
}
</script>