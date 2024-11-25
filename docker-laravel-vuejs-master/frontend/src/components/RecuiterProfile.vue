<template>
    <div>
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
                                <label class="labels">Nome completo</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    placeholder="Nome completo" 
                                    v-model="company_name"
                                    @input="convertToUpperCase"
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
                                <label class="labels">Email </label>
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
                            <button class="btn btn-primary profile-button" type="button" @click="editProfile = true">Editar Perfil</button>
                            <Modal :show="editProfile" @close="editProfile = false">
                                <form>
                                    <h2>Editar Perfil</h2>
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
                                                v-model="company_name"
                                                @input="convertToUpperCase"
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
                                            <label class="labels">Email </label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                placeholder="Email" 
                                                v-model="email"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">CEP</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="CEP" 
                                            v-model="cep"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Rua</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Rua" 
                                            v-model="address.street"
                                        />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Bairro</label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            placeholder="Bairro" 
                                            v-model="address.neighborhood"> 
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="labels">Cidade</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                placeholder="Cidade" 
                                                v-model="address.city"
                                            />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Estado</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                placeholder="Estado" 
                                                v-model="address.state"
                                            />
                                        </div>
                                    </div>
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
import { saveProfile } from '../services/SaveProfileService';

export default {
    name: "UserProfileRecrutador",
    components: {
        NavbarCandidato,
        Modal,
    },
    data() {
        return {
            editProfile: false,
            showModal: false,
            company_name: "",
            email: "",
            phone: "",
            address: {
                street: '',
                neighborhood: '',
                city: '',
                state: '',
            },
            date_of_birth: "",
            perfilPicture:
                "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg",
            address: {
                street: "",
                neighborhood: "",
                city: "",
                state: "",
            },
            cep: "",
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
                    const { company_name, email, neighborhood,street, phone, city, state, date_of_birth, perfilPicture, address } =
                        response.data;
                    this.company_name = company_name;
                    this.email = email;
                    this.phone = phone;
                    this.street = street;
                    this.neighborhood = neighborhood;
                    this.city = city;
                    this.state = state;
                    this.date_of_birth = date_of_birth;
                    this.address = address;
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
                this.perfilPicture = URL.createObjectURL(file);
            }
        },
        salvarPerfil() {
            const token = localStorage.getItem("token");
            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }
            const updatedProfile = {
                company_name: this.company_name,
                email: this.email,
                phone: this.phone,
                street: this.street,
                neighborhood: this.neighborhood,
                city: this.city,
                state: this.state,
                date_of_birth: this.date_of_birth,
                address: this.address,
                cep: this.cep,
            };
            const headers = {
                Authorization: `Bearer ${token}`,
            };

            saveProfile(updatedProfile, headers)
                .then(() => {
                    alert("Perfil salvo com sucesso!");
                })
                .catch((error) => {
                    console.error("Erro ao salvar o perfil: ", error);
                    alert("Não foi possível salvar o perfil. Tente novamente.");
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
