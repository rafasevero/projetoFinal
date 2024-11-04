<template>
    <div>
        <NavbarCandidato />
        <Applications />
        <Footer />
    </div>
</template>

<script>
import Applications from '@/components/Applications.vue';
import Footer from '@/components/Footer.vue';
import NavbarCandidato from '@/components/NavbarCandidato.vue';

export default {
    name: 'ApplicationView',
    components: {
        NavbarCandidato,
        Applications,
        Footer,
    }
}
</script>