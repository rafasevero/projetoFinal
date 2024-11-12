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
                                    placeholder="exemplo"
                                    v-model="nome"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Razão social</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="exemplo"
                                >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Celular</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="enter phone number"
                                >
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="enter email id"
                                    v-model="email"
                                >
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Endereço</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="enter address line 1"
                                >
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Country</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="country"
                                >
                            </div>
                            <div class="col-md-6">
                                <label class="labels">State/Region</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    placeholder="state"
                                >
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
            nome: '',
            email: '',
            profileImage: '',
        };
    },
    created() {
        this.fetchUserProfile();
    },
    methods: {
        async fetchUserProfile() {
            try {
                const response = await axios.get('/api/recruiter/profile', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                });
                const user = response.data;
                this.nome = user.name;
                this.email = user.email;
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
    border: none
}

.profile-button:hover {
    background: #124366
}

.profile-button:focus {
    background: #4ea1db;
    box-shadow: none
}

.profile-button:active {
    background: #4ea1db;
    box-shadow: none
}

.back:hover {
    color: #4ea1db;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #4ea1db;
    color: #fff;
    cursor: pointer;
    border: solid 1px #4ea1db;
    transition: 0.5s;   
}
</style>