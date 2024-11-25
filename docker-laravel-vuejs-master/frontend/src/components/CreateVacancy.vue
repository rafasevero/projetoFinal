<template>
    <div class="container">
        <form @submit.prevent="createVacancy" class="row g-3 form-container">
            <div id="form-group" class="col-md-4 text-center">
                <img :src="perfilPicture" alt="logo da empresa" id="company_logo" class="img-fluid" />
            </div>

            <div class="col-md-4">
                <label for="company_name" class="form-label" id="company">Nome da empresa</label>
                <input type="text" class="form-control" id="company_name" v-model="company_name" placeholder="Exemplo"
                    equired />
            </div>

            <div class="col-md-4">
                <label for="vacancy_name" class="form-label" id="vacancy_name">Nome da vaga</label>
                <input type="text" class="form-control" id="vacancy_name" v-model="vacancy_name" placeholder="Exemplo"
                    required />
            </div>

            <div class="mb-3">
                <label for="description" class="form-label" id="description">Descrição da vaga</label>
                <textarea class="form-control" id="description" v-model="description" rows="3"
                    placeholder="Descrição da vaga" required></textarea>
            </div>

            <div class="mb-3">
                <label for="requirements" class="form-label" id="requirements">Requisitos</label>
                <textarea class="form-control" id="requirements" v-model="requirements" rows="3"
                    placeholder="Requisitos para se cadastrar na vaga" required></textarea>
            </div>

            <div class="col-md-4">
                <label for="local" class="form-label" id="local">Local</label>
                <input type="text" class="form-control" id="local" v-model="local" placeholder="Brasília" required />
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
                <input type="number" class="form-control" id="salary" v-model="salary" placeholder="1.234,00"
                    required />
            </div>

            <div class="col-md-4">
                <label for="min_age" class="form-label" id="min_age">Idade mínima</label>
                <input type="number" class="form-control" id="min_age" v-model="min_age" placeholder="18" required
                    @blur="checkAge" :class="{ 'is-invalid': min_age < 16 && min_age !== '' }" />
                <div v-if="min_age < 16 && min_age !== ''" class="invalid-feedback">A idade mínima deve ser 16 anos ou mais.</div>
            </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Data de criação da vaga</label>
                    <input type="date" class="form-control" id="date" v-model="date" required />
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit">Criar Vaga</button>
                </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

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
            min_age: '',
            date: ''
        };
    },

    created() {
        this.fetchCompanyData();
    },

    methods: {
        async fetchCompanyData() {
            const token = localStorage.getItem("token");

            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }

        },

        async createVacancy() {
            const token = localStorage.getItem("token");

            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }

            const vacancyData = {
                company: this.company_name,
                vacancy_name: this.vacancy_name,
                description: this.description,
                requirements: this.requirements,
                local: this.local,
                work_modality: this.work_modality,
                salary: this.salary,
                min_age: this.min_age,
                date: this.date
            };

            try {
                await axios.post('http://127.0.0.1:8000/api/index_vacancies', vacancyData, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                this.$router.push('/index_vacancies');
            } catch (error) {
                console.error('Erro ao criar vaga:', error.response ? error.response.data : error.message);
                alert("Erro ao criar a vaga.");
            }
        },

        // checkAge() {
        //     if (this.min_age <16)
        //         this.min_age = 16;
        //     }
        // }
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

#company_logo {
    width: 150px;
    height: auto;
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

.text-center {
    text-align: center;
}
</style>
