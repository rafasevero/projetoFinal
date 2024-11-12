<template>
    <div>
        <NavbarCandidato />
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">

                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <!-- Imagem de Perfil -->
                        <img
                            class="rounded-circle mt-5" 
                            width="150px" 
                            :src="profileImage" 
                            alt="Imagem de Perfil"
                        >
                        
                        <!-- Botão para alterar a imagem -->
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
                        
                        <!-- Nome Dinâmico -->
                        <span class="font-weight-bold"></span>
                        <span class="text-black-50"></span>

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
                                    placeholder="first name" 
                                    v-model="nome"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Sobrenome</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="surname" 
                                    v-model="sobrenome"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Data de Nascimento</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    v-model="dataNascimento"
                                />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Celular</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="enter phone number" 
                                    v-model="celular"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="enter email id" 
                                    v-model="email"
                                />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Endereço</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="enter address line 1" 
                                    v-model="endereco"
                                />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Country</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="country" 
                                    v-model="pais"
                                />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">State/Region</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="state" 
                                    v-model="estado"
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
                            <label class="labels">Experiencia</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="experience" 
                            />
                        </div><br>
                        <div class="col-md-12">
                            <label class="labels">Escrava sobre</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                placeholder="additional details" 
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
import NavbarCandidato from './NavbarCandidate.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'UserProfile',
    components: {
        NavbarCandidato
    },
    data() {
        return {
            nome: 'Edogaru',  // Nome inicial do usuário
            sobrenome: 'Silva',  // Sobrenome inicial
            email: 'edogaru@mail.com.my',
            celular: '',
            endereco: '',
            pais: '',
            estado: '',
            dataNascimento: '',
            profileImage: 'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg',  // Imagem de perfil inicial
        };
    },
    methods: {
        // Função para abrir o seletor de arquivos
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        // Função para alterar a imagem de perfil
        onImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.profileImage = URL.createObjectURL(file);  // Atualiza a imagem do perfil
            }
        },
        // Função para salvar o perfil
        salvarPerfil() {
            alert(`Perfil salvo!\nNome: ${this.nome} ${this.sobrenome}\nImagem atualizada!`);
            // Aqui você pode adicionar a lógica para salvar as informações em um banco de dados, se necessário
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

.profile-button:active {
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
