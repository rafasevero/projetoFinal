<template>
    <div>
        <nav class="navbar">
            <div class="logo-navbar">
                <img src="../assets/img/RRM LOGO(1).jpg" alt="logo">
            </div>
            <div class="links-navbar">
                <router-link to="/vagas">Vagas</router-link>
                <router-link to="/perfil">Meu Perfil</router-link>
                <router-link to="/application">Minhas Candidaturas</router-link>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'NavbarCandidato'
}
</script>

<style>
:root {
    /*colors*/
    --background-color: #faf0f0;
    --primary-color: #4ea1db;
    --secondary-color: #31312f;
    --text-color: #ffffff;

    /*font*/
    --font-family: 'Roboto', sans-serif;

    /*margins*/
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