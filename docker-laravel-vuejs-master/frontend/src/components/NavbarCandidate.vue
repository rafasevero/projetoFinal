<template>
    <div>
        <nav class="navbar">
            <div class="logo-navbar">
                <img src="../assets/img/RRM LOGO(1).jpg" alt="logo">
            </div>
            <div class="links-navbar">
                <router-link to="/vacanciesUser">Vagas</router-link>
                <router-link to="/userProfile">Meu Perfil</router-link>
                <router-link to="/application">Minhas Candidaturas</router-link>
                <router-link to="/" @click.prevent="logout">Sair</router-link>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'NavbarCandidate',

    methods: {
        logout() {
            
            localStorage.removeItem('authToken');
            this.$router.push('/');
            alert('Você foi desconectado com sucesso!');
        }
    }
}
</script>

<style >
:root {
    --background-color: #faf0f0;
    --primary-color: #4ea1db;
    --secondary-color: #31312f;
    --text-color: #ffffff;

    --font-family: 'Roboto', sans-serif;

    --borders: 25px
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--primary-color);
    padding: 3px;
    top: 0;
    width: 100%;
}

.logo-navbar img {
    width: 90px;
    height: 100px;
    margin-left: var(--borders);
}

.links-navbar a {
    color: var(--text-color);
    text-decoration: none;
    margin-right: var(--borders);
    font-family: var(--font-family);
    font-size: 18px;
}

.links-navbar a:hover {
    color: var(--secondary-color);
    transition: 0.5s;
}
</style>