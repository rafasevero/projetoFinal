<template>
    <div>
        <NavbarCandidato />
        <main>
            <VagasView />
        </main>
    </div>
</template>

<script>
import VagasView from './VagasView.vue';

    export default {
        name: 'UserPageView',
        components: {
            NavbarCandidato,
            VagasView
        }
    }
</script>

<style> 

</style>