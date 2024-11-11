<template>
    <div class="container">
        <h1>Vagas Disponíveis</h1>
      </div>
      <div class="card-vagas" v-for="vacancies in vacanciesData" :key="vacancies.id">
        <img :src="company_logo" :alt="company_logo">
        <h3>{{ company_name }}</h3>
        <p>{{ vacancy_name }}</p>
        <button @click="openModal(vacancies.id)">Ver mais</button>
      </div>
      <div v-if="showModal" class="modal">
          <div class="modal-content">
              <div class="modal-header">
                  <span class="close" @click="closeModal">&times;</span>
              </div>
              <div class="modal">
                  <h2>Título: {{ vacanciesData.company_name }}</h2>
                  <p>Descrição: {{ vacanciesData.description }}</p>
                  <p>Requisitos: {{ vacanciesData.requirements }}</p>
                  <p>Local: {{ vacanciesData.location }}</p>
                  <p>Tipo: {{ vacanciesData.work_modality }}</p>
                  <p>Valor: {{ vacanciesData.salary }}</p>
              </div>
          </div>
      </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    name: 'AvailableVacancies'
    return {
      searchQuery: '', // Guarda o valor da pesquisa
      vagas: [] // Armazena as vagas carregadas da API
    };
  },
  computed: {
    filteredVagas() {
      // Filtra as vagas de acordo com o valor da pesquisa
      return this.vagas.filter(vaga =>
        vaga.titulo.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  methods: {
    async fetchVagas() {
      try {
        const response = await axios.get('http://localhost:8000/api/vagas');
        this.vagas = response.data;
      } catch (error) {
        console.error('Erro ao buscar vagas:', error);
      }
    }
  },
  mounted() {
    this.fetchVagas(); // Busca as vagas quando o componente é montado
  }
};
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
