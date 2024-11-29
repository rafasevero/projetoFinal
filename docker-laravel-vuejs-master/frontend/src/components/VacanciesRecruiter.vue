<template>
  <div class="container">
    <div class="conteiner">
      <h1>Minhas Vagas</h1>
      <button @click="goToCreateVacancy">Cadastrar nova vaga</button>
    </div>
    <ul>
      <li v-if="filteredVagas.length === 0">Nenhuma vaga disponível</li>
      <li v-else v-for="vaga in filteredVagas" :key="vaga.id">
        <div class="card-vagas">
          <img :src="vaga.company_logo" :alt="vaga.company" />
          <h3>{{ vaga.company }}</h3>
          <p>{{ vaga.vacancy_name }}</p>
          <button class="btn-more" @click="openModal(vaga.id)">Ver mais</button>
        </div>
      </li>
    </ul>

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

          <button class="btn-more" @click="fetchCandidatos">Ver Candidatos</button>

          <div v-if="candidatos.length > 0">
            <h3>Candidatos:</h3>
            <ul>
              <li v-for="candidato in candidatos" :key="candidato.id">
                <p>{{ candidato.full_name }} - {{ candidato.email }}</p>
              </li>
            </ul>
          </div>

          <button class="btn-more" @click="closeVaga(selectedVaga.id)">Fechar vaga</button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { VagasCriadas } from "../services/VagasCriadas";
import axios from 'axios';

export default {
  data() {
    return {
      vagas: [],
      filteredVagas: [],
      selectedVaga: null,
      showModal: false,
      empresaLogadaId: null,
      candidatos: []
    };
  },
  methods: {
    async fetchVagas() {
      try {
        const response = await VagasCriadas.getJobsCreated();
        this.vagas = response.data.vacancies;

        const empresaLogadaId = this.getEmpresaLogadaId();

        if (!empresaLogadaId) {
          console.error("Não foi possível obter o ID da empresa logada.");
        }

        this.filteredVagas = this.vagas.filter(vaga => vaga.company_id === empresaLogadaId || !empresaLogadaId);

        if (this.filteredVagas.length === 0) {
          console.log("Nenhuma vaga encontrada para a empresa logada.");
        }

      } catch (error) {
        console.error("Erro ao buscar vagas criadas:", error);
      }
    },

    getEmpresaLogadaId() {
      const id = localStorage.getItem("empresaLogadaId");
      console.log("ID da empresa logada:", id);
      return id;
    },


    async fetchCandidatos() {
      const ApplyId = this.selectedVaga.id;

      const token = localStorage.getItem('token');
      try {
        const response = await axios.get(`http://localhost:8000/api/recruiter/getUsersForVacancies/${ApplyId}`, {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
        this.candidatos = response.data.candidates;
      } catch (error) {
        console.error("Erro ao buscar candidatos:", error);
        alert("Erro ao buscar candidatos.");
      }
    },


    async closeVaga(vagaId) {
      const token = localStorage.getItem('token');
      try {
        const response = await fetch(`http://127.0.0.1:8000/api/recruiter/destroyVacancy/${vagaId}`, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
          }
        });

        if (response.ok) {
          this.vagas = this.vagas.filter(vaga => vaga.id !== vagaId);
          this.filteredVagas = this.filteredVagas.filter(vaga => vaga.id !== vagaId);

          this.closeModal();
          this.showSuccessMessage("Vaga excluída com sucesso!");
        } else {
          const errorResponse = await response.json();
          console.error('Erro ao excluir vaga:', errorResponse.message);
          this.showErrorMessage(errorResponse.message || "Erro ao excluir a vaga.");
        }
      } catch (error) {
        console.error("Erro ao excluir vaga:", error);
        this.showErrorMessage("Erro ao excluir a vaga. Tente novamente.");
      }
    },


    showSuccessMessage(message) {
      alert(message);
    },

    showErrorMessage(message) {
      alert(message);
    },

    openModal(vagaId) {
      this.selectedVaga = this.vagas.find(vaga => vaga.id === vagaId);
      if (this.selectedVaga) {
        this.showModal = true;
        this.candidatos = [];  // Limpa os candidatos anteriores
      } else {
        console.error("Vaga não encontrada com o ID:", vagaId);
      }
    },

    closeModal() {
      this.showModal = false;
      this.selectedVaga = null;
    },

    goToCreateVacancy() {
      this.$router.push("/CreateVacancy");
    }
  },

  mounted() {
    this.fetchVagas();
    this.filteredVagas = this.vagas;
  }
};
</script>




<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}

ul li {
  list-style: none
}

h1 {
  font-size: 24px;
  margin-bottom: 25px;
  text-align: center;
}

button {
  background-color: #4ea1db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  border: 1px solid #4ea1db;
  cursor: pointer;
  margin: 0 auto;
  margin-bottom: 50px;
}

button:hover {
  background-color: #ffffff;
  color: #4ea1db;
  border: 1px solid #4ea1db;
  transition: 0.5s;
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

.btn-candidatar {
  color: #fff;
  background-color: #4ea1db;
  border: 2px solid #1f78b8;
  padding: 10px 20px;
  border-radius: 5px;
  font-size: 1rem;
  font-weight: bold;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease-in-out;
  /* Melhorando a transição para suavizar o efeito */
  text-transform: uppercase;
  text-align: center;
}

.btn-candidatar:hover {
  color: #4ea1db;
  background-color: #fff;
  border: 2px solid #1f78b8;
  transform: scale(1.05);
  /* Efeito de leve aumento no botão */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  /* Adicionando sombra suave */
}

.btn-candidatar:active {
  transform: scale(1);
  /* Efeito de pressionar, volta ao tamanho original */
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

@media (max-width: 768px) {
  h1 {
    font-size: 20px;
  }
}
</style>
