<template>
    <div>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img
                            class="rounded-circle mt-5" 
                            width="150px"
                            :src="profileImage"
                            alt="Imagem de perfil"
                        >
                        <input 
                            type="file" 
                            @change="onImageChange" 
                            style="display: none;" 
                            ref="fileInput"
                        />
                        <button 
                            class="btn btn-primary mt-3" 
                            @click="triggerFileInput"
                        >
                            Alterar Imagem
                        </button>
                        
                        <span class="font-weight-bold">{{ company_name }}</span>
                        <span class="text-black-50">{{ email }}</span>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Configurações do Perfil</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Nome da Empresa</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Nome da Empresa"
                                    v-model="company_name"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Razão social</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Razão Social"
                                    v-model="social_name"
                                >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Celular</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Telefone"
                                    v-model="phone"
                                >
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Email"
                                    v-model="email"
                                >
                            </div>
                            <div class="col-md-12">
                                <label class="labels">CEP</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Endereço"
                                    v-model="cep"
                                >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Cidade</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Cidade"
                                    v-model="city"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Estado/Região</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Estado"
                                    v-model="state"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">CNPJ</label>
                                <input
                                type="text"
                                class="form-control"
                                placeholder="CNPJ"
                                v-model="cnpj"
                                >
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button 
                                class="btn btn-primary profile-button" 
                                type="button" 
                                @click="salvarPerfil"
                            >
                                Salvar Perfil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    name: 'RecruiterProfile',
    data() {
        return {
            company_name:"",
            social_name:"",
            phone:"",
            email:"",
            cep:"",
            city:"",
            state:"",
            cnpj:"",
            profileImage:""
        };
    },
    methods: {
        fetchRecruiterProfile() {
            // Obtém o token do localStorage
            const token = localStorage.getItem("token");
            
            // Verifica se o token existe
            if (!token) {
                alert('Perfil não encontrado. Tente logar novamente.');
                return;
            }

            // Requisição para buscar os dados do recrutador
            axios.get('http://localhost:8000/api/user/pullAuth', {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            })
            .then((response) => {
                // Verifica se a resposta contém os dados esperados
                const { company_name, social_name, phone, email, cep, city, state, cnpj, profileImage } = response.data;

                // Atribui os valores ao data do Vue para atualizar o perfil
                this.company_name = company_name || "";
                this.social_name = social_name || "";
                this.phone = phone || "";
                this.email = email || "";
                this.cep = cep || "";
                this.city = city || "";
                this.state = state || "";
                this.cnpj = cnpj || "";
                // Se houver uma imagem de perfil, atribui
                if (profileImage) {
                    this.profileImage = profileImage;
                }
            })
            .catch((error) => {
                console.error('Erro ao buscar perfil do recrutador:', error);
            });
        },
        created() {
            this.fetchRecruiterProfile();
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        onImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.profileImage = URL.createObjectURL(file);
            }
        },
        salvarPerfil() {
            alert(`Perfil salvo! Nome atualizado para: ${this.nome}`);
        },
    },
}
</script>

<style scoped>
.form-control:focus {
    box-shadow: none;
    border-color: #4ea1db;
}

.profile-button {
    background: #4ea1db;
    box-shadow: none;
    border: none;
}

.profile-button:hover {
    background: #124366;
}

.labels {
    font-size: 11px;
}
</style>
