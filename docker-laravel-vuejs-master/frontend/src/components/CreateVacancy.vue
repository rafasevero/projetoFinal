<template>
    <div class="container">
        <form @submit.prevent="createVacancy" class="row g-3 form-container">
            <div id="form-group" class="col-md-4 text-center">
                <img :src="perfilPicture" alt="logo da empresa" id="company_logo" class="img-fluid" />
            </div>

            <div class="col-md-4">
                <label for="company_name" class="form-label" id="company">Nome da empresa</label>
                <input type="text" class="form-control" id="company_name" v-model="company_name" readonly>
            </div>

            <div class="col-md-4">
                <label for="vacancy_name" class="form-label" id="vacancy_name">Nome da vaga</label>
                <input type="text" class="form-control" id="vacancy_name" v-model="vacancy_name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label" id="description">Descrição da vaga</label>
                <textarea class="form-control" id="description" v-model="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="requirements" class="form-label" id="requirements">Requisitos</label>
                <textarea class="form-control" id="requirements" v-model="requirements" rows="3" required></textarea>
            </div>

            <div class="col-md-4">
                <label for="local" class="form-label" id="local">Local</label>
                <input type="text" class="form-control" id="local" v-model="local" required>
            </div>

            <div class="mb-3">
                <label for="work_modality" class="form-label" id="work_modality">Modalidade de Trabalho</label>
                <select class="form-select" id="work_modality" v-model="work_modality" required>
                    <option value="">Selecione</option>
                    <option value="present">Presencial</option>
                    <option value="home_office">Home Office</option>
                    <option value="hybrid">Híbrido</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="salary" class="form-label" id="salary">Valor do salário</label>
                <input type="number" class="form-control" id="salary" v-model="salary" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Data de criação da vaga</label>
                <input type="date" class="form-control" id="date" v-model="date" required>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit">Criar Vaga</button>
            </div>
        </form>
    </div>
</template>


<script>
import axios from 'axios';
export default {
    name: 'CreateVacancy',
    data() {
        return {
            company_name: '',
            perfilPicture: '',
            vacancy_name: '',
            description: '',
            requirements: '',
            local: '',
            work_modality: '',
            salary: '',
            date: ''
        };
    },
    created() {
        this.fetchCompanyData();
    },
    methods: {
        async fetchCompanyData() {
            try {
                const response = await fetch('/api/recruiter/vacancy_register');
                const data = await response.json();
                this.company_name = data.name;
                this.perfilPicture = data.logo_url;
            } catch (error) {
                console.error("Erro ao buscar os dados da empresa:", error);
            }
        },
        async createVacancy() {
            // Dados do formulário
            const vacancyData = {
                company: this.company_name,
                vacancy_name: this.vacancy_name,
                description: this.description,
                requirements: this.requirements,
                local: this.local,
                work_modality: this.work_modality,
                salary: this.salary,
                date: this.date
            };

            try {
                // Envio ao backend
                await axios.post('http://localhost:8000/api/vagas', vacancyData);

                // Redireciona para a página de vagas
                this.$router.push('/vagas');
            } catch (error) {
                console.error('Erro ao criar vaga:', error);
            }
        }
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

.form-control:focus {
    box-shadow: none;
    border-color: #4ea1db;
}

.form-select:focus {
    box-shadow: none;
    border-color: #4ea1db;
}

button {
    background-color: #4ea1db;
    color: white;
    padding: 10px 20px;
    border: 1px solid #4ea1db;
    cursor: pointer;
    margin: 0 auto;
}

button:hover {
    background-color: #ffffff;
    color: #4ea1db;
    border: 1px solid #4ea1db;
    transition: 0.5s;
}


.labels {
    font-size: 14px;
    font-weight: bold;
}


textarea.form-control {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 14px;
}

textarea.form-control:focus {
    border-color: #4ea1db;
    box-shadow: none;
}

input.form-control,
select.form-select {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 14px;
}

input.form-control:focus,
select.form-select:focus {
    border-color: #4ea1db;
    box-shadow: none;
}

#company_logo {
    width: 150px;
    height: auto;
}

.form-label {
    font-weight: bold;
    color: #333;
    font-size: 14px;
}

.row.g-3 {
    margin: 0;
}

.mb-3 {
    margin-bottom: 1.5rem;
}

@media (max-width: 767px) {
    .col-md-4 {
        margin-bottom: 20px;
    }

    .text-center {
        text-align: center;
    }
}
</style>
