<template>
        <div class="container">
        <h1>Minhas Candidaturas</h1>
        <input type="text" v-model="searchQuery" placeholder="Pesquise uma vaga..." />

        <ul>
            <li v-for="vaga in filteredVagas" :key="vaga.id">
                {{ vaga.titulo }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'Applications'
    }
</script>

<style scoped>
    .container {
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
}

h1 {
  font-size: 24px;
  margin-bottom: 10px;
}

input {
  padding: 8px;
  width: 100%;
  max-width: 400px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
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

@media (max-width: 768px) {
  h1 {
    font-size: 20px;
  }
  
  input {
    font-size: 14px;
    padding: 6px;
  }
  
  li {
    font-size: 16px;
    padding: 8px;
  }
}

@media (max-width: 480px) {
  h1 {
    font-size: 18px;
    margin-bottom: 15px;
  }

  input {
    padding: 6px;
    font-size: 14px;
  }

  li {
    font-size: 14px;
    padding: 6px;
  }
}
</style>