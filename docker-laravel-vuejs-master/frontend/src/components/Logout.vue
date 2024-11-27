<template>

</template>

<script>
export default {
    name: logout,
    
    methods: {
        logout() {

        localStorage.removeItem('authToken'); //remove do local storeage

        this.$router.push('/home');

        alert('Você foi desconectado com sucesso!');
    }
    }
}
</script>