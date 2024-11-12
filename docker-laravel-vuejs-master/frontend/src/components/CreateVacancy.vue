<template>
    <div class="container">
        <form class="row g-3 form-container">
            <div id="form-group" class="col-md-4 text-center">
                <img src="" alt="logo da empresa" id="company_logo" class="img-fluid" />
            </div>

            <div class="col-md-4">
                <label for="validationDefault01" class="form-label" id="company">Nome da empresa</label>
                <input type="text" class="form-control" id="company_name" required>
            </div>

            <div class="col-md-4">
                <label for="validationDefault01" class="form-label" id="vacancy_name">Nome da vaga</label>
                <input type="text" class="form-control" id="vacancy_name" required>
            </div>

            <div class="mb-3">
                <label for="validationTextarea" class="form-label" id="description">Descrição da vaga</label>
                <textarea class="form-control" id="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="validationTextarea" class="form-label" id="requirements">Requisitos</label>
                <textarea class="form-control" id="requirements" rows="3" required></textarea>
            </div>

            <div class="col-md-4">
                <label for="validationDefault01" class="form-label" id="local">Local</label>
                <input type="text" class="form-control" id="local" required>
            </div>

            <div class="mb-3">
                <label for="work_modality" class="form-label" id="work_modality">Modalidade de Trabalho</label>
                <select class="form-select" required id="work_modality">
                    <option value="">Selecione</option>
                    <option value="present">Presencial</option>
                    <option value="home_office">Home Office</option>
                    <option value="hybrid">Híbrido</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="validationDefault01" class="form-label" id="salary">Valor do salário</label>
                <input type="number" class="form-control" id="salary" required>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Data de criação da vaga</label>
                <input type="date" class="form-control" id="date" required>
            </div>

            <div class="col-md-12 text-center">
                <button type="submit">Criar Vaga</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: 'CreateVacancy'
}
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
