<template>
  <div class="container">
    <div class="search-bar">
      <h1>Vagas Disponíveis</h1>
      <input type="text" v-model="searchQuery" placeholder="Pesquise uma vaga..." />
    </div>

    <ul>
      <li v-for="vaga in filteredVagas" :key="vaga.id">
        <div class="card-vagas">
          <img :src="vaga.company_logo" :alt="vaga.company_name" />
          <h3>{{ vaga.company }}</h3>
          <p>{{ vaga.vacancy_name }}</p>
          <button class="btn-more" @click="openModal(vaga.id)">Ver mais</button>
        </div>
      </li>
    </ul>

    <!-- Modal para exibir mais detalhes -->
    <div v-if="showModal" class="modal" :class="{ show: showModal }" @click="closeModal">
      <div class="modal-content" @click.stop>
        <div class="modal-header">
          <span class="close" @click="closeModal">&times;</span>
        </div>
        <div class="modal-body">
          <h2>Título: {{ selectedVaga.vacancy_name }}</h2>
          <p>Descrição: {{ selectedVaga.description }}</p>
          <p>Requisitos: {{ selectedVaga.requirements }}</p>
          <p>Local: {{ selectedVaga.location }}</p>
          <p>Tipo: {{ selectedVaga.work_modality }}</p>
          <p>Valor: {{ selectedVaga.salary }}</p>
          <button class="btn-candidatar" @click="applyForm">Candidate-se</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ShowVagas } from '@/services/RegisterVacancies';

export default {
  name: 'VacanciesUser',
  data() {
    return {
      searchQuery: '',
      vacanciesData: [],
      selectedVaga: {},
      showModal: false,
      loading: false,
      error: false,
    };
  },
  computed: {
    filteredVagas() {
      return this.vacanciesData.filter(vaga =>
        vaga.vacancy_name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    }
  },
  methods: {
    async fetchVagas() {
      try {
        const response = await ShowVagas();
        this.vacanciesData = Array.isArray(response.data.vacancies) ? response.data.vacancies : [];
      } catch (error) {
        console.error("Erro ao buscar vagas: ", error);
        this.error = true;
      }
    },
    openModal(vagaId) {
      // Localize a vaga pelo id e armazene-a em selectedVaga
      this.selectedVaga = this.vacanciesData.find(vaga => vaga.id === vagaId);
      if (this.selectedVaga) {
        this.showModal = true;  // Abre o modal somente se a vaga for encontrada
      }
    },
    closeModalIfOutside(event) {
      // Verifica se o clique foi na sobreposição (não no conteúdo)
      if (event.target === event.currentTarget) {
      this.closeModal(); // Fecha o modal
      }
    },
    closeModal() {
      this.showModal = false;
    },
    async applyForm() {
      console.log("Candidatando-se à vaga:", this.selectedVaga.id);
    }
  },
  mounted() {
    this.fetchVagas();
  }
};
</script>

<style scoped>
ul li{
  list-style: none
}
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
}
.card-vagas {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 16px;
  margin-bottom: 16px;
}
.card-vagas img {
  max-width: 100px;
  border-radius: 50%;
}
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  width: 80%;
  max-width: 600px;
}
.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
.btn-candidatar {
  color:#fff;
  background-color: #4ea1db;
  border: 2px solid #1f78b8;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: .2s;
}
.btn-candidatar:hover {
  transition: .2s;
  color:#4ea1db;
  background-color: #fff;
  border:2px solid #1f78b8;
}
.btn-more {
  color: #fff;
  background-color: #4ea1db;
  border: 2px solid #1f78b8;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: .2s;
}
.btn-more:hover {
  transition: .2s;
  color:#4ea1db;
  background-color: #fff;
  border:2px solid #1f78b8;
}
.search-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

</style>
