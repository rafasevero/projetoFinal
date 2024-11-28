<template>
    <div>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" :src="perfilPicture" alt="Imagem de Perfil">

                        <input type="file" @change="onImageChange" style="display: none;" ref="fileInput" />
                        <button class="btn btn-primary mt-3" @click="triggerFileInput">
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
                                <label class="labels">Nome da empresa</label>
                                <input type="text" class="form-control" placeholder="Nome da empresa"
                                    v-model="company_name" @input="convertToUpperCase" readonly />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Celular</label>
                                <input type="text" class="form-control" placeholder="Número de telefone" v-model="phone"
                                    readonly />
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email </label>
                                <input type="text" class="form-control" placeholder="Email" v-model="email" readonly />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Cidade</label>
                                <input type="text" class="form-control" placeholder="Cidade" v-model="city" readonly />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Estado</label>
                                <input type="text" class="form-control" placeholder="Estado" v-model="state" readonly />
                            </div>
                            <div class="col-md-6">
                                <label class="labels">CEP</label>
                                <input type="text" class="form-control" placeholder="85000-000" v-model="cep"
                                    readonly />
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="button"
                                @click="editProfile = true">Editar Perfil</button>

                            <Modal :show="editProfile" @close="editProfile = false">
                                <form>
                                    <h2>Editar Perfil</h2>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                    </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="labels">Nome da empresa</label>
                                            <input type="text" class="form-control" placeholder="Nome da empresa"
                                                v-model="company_name" @input="convertToUpperCase" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="labels">Celular</label>
                                            <input type="text" class="form-control" placeholder="Número de telefone"
                                                v-model="phone" />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Email </label>
                                            <input type="text" class="form-control" placeholder="Email"
                                                v-model="email" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">CEP</label>
                                        <input type="text" class="form-control" placeholder="CEP" v-model="cep" />
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="labels">Cidade</label>
                                            <input type="text" class="form-control" placeholder="Cidade"
                                                v-model="city" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Estado</label>
                                            <input type="text" class="form-control" placeholder="Estado"
                                                v-model="state" />
                                        </div>
                                    </div>
                                    <button class="btn btn-primary profile-button save-profile" type="button"
                                        @click="salvarPerfil">
                                        Salvar Perfil
                                    </button>
                                </form>
                            </Modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import axios from "axios";
import NavbarCandidato from "./NavbarCandidate.vue";
import Modal from './Modal.vue';

export default {
    name: "UserProfileRecrutador",
    components: {
        NavbarCandidato,
        Modal,
    },
    data() {
        return {
            editProfile: false,
            recruiterId: null,
            company_name: "",
            email: "",
            phone: "",
            perfilPicture: "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg",
            cep: "",
            profileImageFile: null // Para armazenar o arquivo da imagem temporariamente
        };
    },
    created() {
        this.fetchUserProfile();
    },
    methods: {
        fetchUserProfile() {
            const token = localStorage.getItem("token");
            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }

            axios
                .get("http://127.0.0.1:8000/api/user/pullAuth", {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                })
                .then((response) => {
                    const { id, company_name, cep, email, phone, city, state, perfilPicture } = response.data;
                    this.id = id;
                    this.company_name = company_name;
                    this.email = email;
                    this.phone = phone;
                    this.cep = cep;
                    this.city = city;
                    this.state = state;
                    if (perfilPicture) {
                        this.perfilPicture = perfilPicture;
                    }
                })
                .catch((error) => {
                    console.error("Erro ao buscar usuário:", error);
                });
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        onImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.perfilPicture = URL.createObjectURL(file); // Atualiza a visualização da imagem
                this.profileImageFile = file; // Armazena o arquivo para enviar ao backend
            }
        },
        salvarPerfil() {
            const token = localStorage.getItem("token");
            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }

            if (!this.company_name || !this.email || !this.phone || !this.city || !this.state || !this.cep) {
                alert("Todos os campos obrigatórios devem ser preenchidos.");
                return;
            }

            const updatedProfile = new FormData();
            updatedProfile.append('id', this.id);
            updatedProfile.append('company_name', this.company_name);
            updatedProfile.append('email', this.email);
            updatedProfile.append('phone', this.phone);
            updatedProfile.append('city', this.city);
            updatedProfile.append('state', this.state);
            updatedProfile.append('cep', this.cep);

            if (this.profileImageFile) {
                updatedProfile.append('perfilPicture', this.profileImageFile);  // Envia a imagem
            }

            const headers = {
                Authorization: `Bearer ${token}`,
            };

            axios
                .put(`http://127.0.0.1:8000/api/recruiter/update/${this.id}`, updatedProfile, { headers })
                .then(() => {
                    alert("Perfil atualizado com sucesso!");
                    this.editProfile = false;
                })
                .catch((error) => {
                    console.error("Erro ao atualizar perfil:", error);
                    alert("Ocorreu um erro ao atualizar o perfil.");
                });
        },
        convertToUpperCase() {
            this.company_name = this.company_name.toUpperCase();
        }
    },
};
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
    margin: 10px;
}

.profile-button:hover {
    background: #124366;
}

.labels {
    font-size: 11px;
}
</style>
