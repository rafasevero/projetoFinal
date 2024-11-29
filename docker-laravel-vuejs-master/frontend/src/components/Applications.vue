<template>
  <div class="container">
    <h1>Minhas Candidaturas</h1>
    <input type="text" v-model="searchQuery" placeholder="Pesquise uma vaga..." />

    <ul v-if="applications.length > 0">
      <li v-for="vaga in filteredVagas" :key="vaga.id">
        <div class="card-vagas">
          <img :src="vaga.company_logo" :alt="vaga.company" />
          <h3>{{ vaga.company }}</h3>
          <p>{{ vaga.vacancy_name }}</p>
          <button class="btn-more" @click="openModal(vaga.id)">Ver mais</button>
        </div>
      </li>
    </ul>
    <p v-else>Nenhuma vaga encontrada.</p>

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
          <p>Idade mínima: {{ selectedVaga.min_age }}</p>
          <p>Tipo: {{ selectedVaga.work_modality }}</p>
          <p>Valor: {{ selectedVaga.salary }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ShowApply } from '@/services/ShowApply';

export default {
  name: 'Applications',
  data() {
    return {
      applications: [], // Lista de candidaturas
      searchQuery: '',  // Query de pesquisa
      selectedVaga: null, // Vaga selecionada para exibição no modal
      showModal: false,  // Controle do modal
    };
  },
  computed: {
    filteredVagas() {
  const filtered = this.applications.filter(vaga => {
    const nomeVaga = vaga.vacancy_name ? vaga.vacancy_name.toLowerCase() : '';
    const nomeEmpresa = vaga.company ? vaga.company.toLowerCase() : '';
    const query = this.searchQuery.toLowerCase();
    return nomeVaga.includes(query) || nomeEmpresa.includes(query);
  });
  console.log("Vagas filtradas:", filtered);
  return filtered;
}
  },
  methods: {
    openModal(vaga) {
      this.selectedVaga = vaga;
      this.showModal = true;
    },
    closeModal() {
      this.selectedVaga = null;
      this.showModal = false;
    },
    loadApplications() {
  ShowApply.getApplications()
    .then(response => {
      console.log("Resposta completa da API:", response);
      if (response.data && Array.isArray(response.data.applications)) {
        this.applications = response.data.applications; // Atribui as candidaturas ao array
        console.log("Applications carregadas no componente:", this.applications);
      } else {
        this.applications = [];
        console.error("A resposta da API não contém um array de candidaturas.");
      }
    })
    .catch(error => {
      console.error("Erro ao carregar candidaturas:", error);
      this.applications = [];
    });
},


    addApplication(vaga) {
      this.applications.push(vaga);  // Adiciona a vaga à lista de candidaturas
      this.$emit('vaga-candidatada', vaga);  // Emite o evento com a vaga candidatar
    }
  },
  mounted() {
    this.loadApplications();  // Carrega as candidaturas ao montar o componente
  }
};
</script>




<style scoped>
ul li {
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

.modal-body {
  padding: 25px 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  color: #333;
  font-size: 1rem;
  line-height: 1.6;
  overflow-y: auto;
  max-height: 400px;
  /* Definindo uma altura máxima para a área */
  box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
}

.modal-body p {
  margin-bottom: 15px;
  font-size: 1.1rem;
  color: #555;
}

.modal-body h3 {
  margin-top: 0;
  font-size: 1.4rem;
  color: #1f78b8;
  margin-bottom: 15px;
}

.modal-body ul {
  margin-top: 10px;
  padding-left: 20px;
  list-style-type: disc;
}

.modal-body ul li {
  margin-bottom: 10px;
  font-size: 1rem;
  color: #333;
}

.modal-body .highlight {
  background-color: #e7f7ff;
  padding: 5px;
  border-radius: 5px;
  color: #1f78b8;
}

.modal-body .notice {
  padding: 10px;
  background-color: #ffefdb;
  border-left: 5px solid #ffb84d;
  margin-top: 20px;
  font-size: 0.9rem;
  color: #b36b00;
  border-radius: 5px;
}

.modal-body a {
  color: #1f78b8;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}

.modal-body a:hover {
  color: #4ea1db;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;

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
  color: #4ea1db;
  background-color: #fff;
  border: 2px solid #1f78b8;
}

.search-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
</style>
