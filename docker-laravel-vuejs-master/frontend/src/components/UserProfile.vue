<template>
    <div>
        <NavbarCandidato />
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img
                            class="rounded-circle mt-5" 
                            width="150px" 
                            :src="perfilPicture" 
                            alt="Imagem de Perfil"
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

                        <span class="font-weight-bold">{{ full_name }}</span>
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
                                <label class="labels">Nome completo</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Nome completo" 
                                    v-model="full_name"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Data de Nascimento</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    v-model="date_of_birth"
                                />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Celular</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Número de telefone" 
                                    v-model="phone"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Email" 
                                    v-model="email"
                                />
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
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Estado</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Estado" 
                                    v-model="state"
                                />
                            </div>
                        </div>
                        <!-- Botão de salvar -->
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
                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Edit Experience</span>
                            <span class="border px-3 p-1 add-experience">
                                <i class="fa fa-plus"></i>&nbsp;Experience
                            </span>
                        </div><br>
                        <div class="col-md-12">
                            <label class="labels">Experiência</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Experiência" 
                            />
                        </div><br>
                        <div class="col-md-12">
                            <label class="labels">Descrição</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="Detalhes adicionais" 
                            />
                        </div>
                        <div class="col-md-12">
                            <label class="labels">Anexar Currículo</label>
                            <input 
                                type="file" 
                                class="form-control-file" 
                                @change="handleFileUpload" 
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HttpService from '@/services/HttpService';
import NavbarCandidato from './NavbarCandidate.vue';
import axios from 'axios';

export default {
    name: 'UserProfile',
    components: {
        NavbarCandidato
    },
    data() {
        return {
            full_name: '',
            email: '',
            phone: '',
            city: '',
            state: '',
            date_of_birth: '',
            perfilPicture: 'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg',
        };
    },
    created() {
        this.fetchUserProfile();
    },
    methods: {
        async fetchUserProfile() {
            try {
                const response = await HttpService.get('/user/profile', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`

                    }
                });
                console.log(response);
                const user = response.data;
                this.full_name = user.full_name || '';
                this.email = user.email || '';
                this.phone = user.phone || '';
                this.city = user.city || '';
                this.state = user.state || '';
                this.date_of_birth = user.date_of_birth || '';
                this.perfilPicture = user.perfilPicture || this.perfilPicture;
            } catch (error) {
                console.error('Erro ao carregar o perfil do usuário:', error);
            }
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        onImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.perfilPicture = URL.createObjectURL(file);
            }
        },
        salvarPerfil() {

        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                console.log('Arquivo de currículo enviado:', file.name);
            }
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

.profile-button:focus {
    background: #4ea1db;
    box-shadow: none;
}

.labels {
    font-size: 11px;
}

.add-experience:hover {
    background: #4ea1db;
    color: #fff;
    cursor: pointer;
    border: solid 1px #4ea1db;
    transition: 0.5s;
}

.form-control-file {
    margin-top: 10px;
    display: block;
    font-size: 14px;
    color: #555;
}

.form-control-file::file-selector-button {
    background-color: #4ea1db;
    color: white;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.form-control-file::file-selector-button:hover {
    background-color: #124366;
}
</style>
    