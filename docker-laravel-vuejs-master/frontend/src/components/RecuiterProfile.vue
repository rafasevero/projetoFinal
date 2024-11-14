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
                        
                        <span class="font-weight-bold">{{ nome }}</span>
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
                                <label class="labels">Nome</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite seu nome"
                                    v-model="nome"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Razão social</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite a razão social"
                                    v-model="razaoSocial"
                                >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Celular</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite seu celular"
                                    v-model="celular"
                                >
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite seu email"
                                    v-model="email"
                                >
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Endereço</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite seu endereço"
                                    v-model="endereco"
                                >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">País</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite seu país"
                                    v-model="pais"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Estado/Região</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="Digite seu estado"
                                    v-model="estado"
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
import HttpService from '@/services/HttpService';
import axios from 'axios';

export default {
    name: 'RecruiterProfile',
    data() {
        return {
            nome: '',
            email: '',
            profileImage: '',
            razaoSocial: '',
            celular: '',
            endereco: '',
            pais: '',
            estado: ''
        };
    },
    created() {
        this.fetchUserProfile();
    },
    methods: {
        async fetchUserProfile() {
            try {
                const response = await HttpService.get('/recruiter/profile', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                const user = response.data;
                this.nome = user.name || '';
                this.email = user.email || '';
                this.profileImage = user.profile_image_url || 'url-da-imagem-padrao.jpg';
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
