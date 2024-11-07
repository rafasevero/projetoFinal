<template>
    <div>
        <NavbarRecruiter />
        <RecruiterProfile />
        <Footer />
    </div>
</template>

<script>
import NavbarRecruiter from '@/components/NavbarRecruiter.vue';
import RecruiterProfile from '@/components/RecuiterProfile.vue';
import Footer from '@/components/Footer.vue';

export default {
    name: 'RecruiterProfileView',
    components: {
        NavbarRecruiter,
        RecruiterProfile,
        Footer,
    }
}

</script>