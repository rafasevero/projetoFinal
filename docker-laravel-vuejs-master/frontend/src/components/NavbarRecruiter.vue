<template>
    <div>
        <nav class="navbar">
            <div class="logo-navbar">
                <img src="../assets/img/RRM LOGO(1).jpg" alt="logo">
            </div>
            <input type="text" v-model="searchQuery" placeholder="Pesquise uma vaga..." />
    <ul>
        <li v-for="vaga in filteredVagas" :key="vaga.id">
            {{ vaga.titulo }}
        </li>
    </ul>
            <div class="links-navbar">
                <router-link to="/availableVacancies">Vagas</router-link>
                <router-link to="/recruiterProfile">Meu Perfil</router-link>
                <router-link to="/vacanciesRecruiter">Minhas Vagas</router-link>
                <router-link to ="/">Sair</router-link>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'NavbarRecruiter'
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

input {
  padding: 8px;
  width: 100%;
  max-width: 400px;
  margin-bottom: 20px;
  border: 1px solid #faf0f0;
  border-radius: 10px;
  background-color: transparent; 
  color: #faf0f0;   
}

ul {
  list-style: none;
  padding: 0;
}

li {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

li:last-child {
  border-bottom: none;
}
</style>