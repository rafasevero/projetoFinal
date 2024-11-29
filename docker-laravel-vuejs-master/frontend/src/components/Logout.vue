<template>

</template>

<script>
export default {
    name: logout,

    methods: {
        logout() {

            localStorage.removeItem('authToken');

            this.$router.push('/home');

            alert('Você foi desconectado com sucesso!');
        }
    }
}
</script>