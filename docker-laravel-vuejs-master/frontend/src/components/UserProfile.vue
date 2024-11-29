    <template>
        <div>
            <NavbarCandidato />
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" :src="perfilPicture" alt="Imagem de Perfil">

                            <input type="file" @change="onImageChange" style="display: none;" ref="fileInput" />
                            <button class="btn btn-primary mt-3" @click="triggerFileInput">
                                Alterar Imagem
                            </button>

                            <span class="font-weight-bold">{{ full_name }}</span>
                            <span class="text-black-50">{{ email }}</span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Nome completo</label>
                                    <input type="text" class="form-control" placeholder="Nome completo"
                                        v-model="full_name" @input="convertToUpperCase" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Data de Nascimento</label>
                                    <input type="date" class="form-control" v-model="date_of_birth" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Celular</label>
                                    <input type="text" @input="formatPhone" class="form-control"
                                        placeholder="Número de telefone" v-model="phone" readonly />
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email </label>
                                    <input type="text" class="form-control" placeholder="Email" v-model="email"
                                        readonly />
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label class="labels">Cidade</label>
                                    <input type="text" class="form-control" placeholder="Cidade" v-model="city"
                                        readonly />
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Estado</label>
                                    <input type="text" class="form-control" placeholder="Estado" v-model="state"
                                        readonly />
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="button"
                                    @click="editProfile = true">Editar Perfil</button>

                                <Modal :show="editProfile" @close="editProfile = false" class="custom-modal">
                                    <form class="modal-form">
                                        <h2 class="modal-title">Editar Perfil</h2>
                                        <div class="modal-header">
                                            <h4 class="text-right">Configurações do Perfil</h4>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="labels">Nome completo</label>
                                                <input type="text" class="form-control" placeholder="Nome completo"
                                                    v-model="full_name" @input="convertToUpperCase" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="labels">Data de Nascimento</label>
                                                <input type="date" class="form-control" v-model="date_of_birth"
                                                    @input="formatdate" />
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Celular</label>
                                                <input type="text" class="form-control" placeholder="Número de telefone"
                                                    v-model="phone" @input="formatPhone" :maxlength="15" required />
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Email</label>
                                                <input type="text" class="form-control" placeholder="Email"
                                                    v-model="email" />
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="labels">CEP</label>
                                                <input type="text" class="form-control" placeholder="CEP" v-model="cep"
                                                    @input="formatCEP" :maxlength="9" required />
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="labels">Cidade</label>
                                                <input type="text" class="form-control" placeholder="Cidade"
                                                    v-model="city" />
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="labels">Estado</label>
                                                <input type="text" class="form-control" placeholder="Estado"
                                                    v-model="state" />
                                            </div>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary save-profile" type="button"
                                                @click="salvarPerfil">Salvar Perfil</button>
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
    name: "UserProfile",
    components: {
        NavbarCandidato,
        Modal,
    },
    data() {
        return {
            editProfile: false,
            showModal: false,
            full_name: "",
            email: "",
            phone: "",
            cep: "",
            address: {
                street: '',
                neighborhood: '',
                city: '',
                state: '',
            },
            date_of_birth: "",
            perfilPicture:
                "https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg",
        };

    },
    created() {
        this.fetchUserProfile();
        this.phone = this.phone.replace(/\D/g, '');
    },
    methods: {
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.experience.resume = file; // Armazena o arquivo no objeto experience
            }
        },
        saveExperience() {
    const formData = new FormData();
    formData.append("resume", this.experience.resume);

    const token = localStorage.getItem("token");

    axios.post("/api/user/storeCurriculum", formData, {
    headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "multipart/form-data"
    },
})
    .then(() => {
        alert("Currículo enviado com sucesso!");
    })
    .catch((error) => {
        console.error("Erro ao enviar currículo:", error);
        alert("Erro ao enviar currículo. Tente novamente.");
    });
},



        formatdate(date) {
            // Se a data for um objeto Date
            if (date instanceof Date) {
                return date.toISOString().split('T')[0]; // Retorna no formato "YYYY-MM-DD"
            }

            // Caso a data seja uma string no formato "YYYY-MM-DD" ou "YYYY-MM-DDTHH:mm:ss.sssZ"
            if (typeof date === 'string' && date.includes('-')) {
                return date.split('T')[0]; // Extrai apenas a parte da data "YYYY-MM-DD"
            }

            return date; // Se não for uma data válida, retorna o valor original
        },
        fetchUserProfile() {
            const token = localStorage.getItem("token");
            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }
            axios
                .get("http://localhost:8000/api/user/pullAuth", {
                    headers: { Authorization: `Bearer ${token}` },
                })
                .then((response) => {
                    const { id, full_name, cep, email, phone, city, state, date_of_birth, perfilPicture } = response.data;
                    this.userId = id; // Armazena o ID do usuário
                    this.full_name = full_name;
                    this.email = email;
                    this.phone = phone;
                    this.cep = cep;
                    this.city = city;
                    this.state = state;
                    this.date_of_birth = this.formatdate(date_of_birth);
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
                const formData = new FormData();
                formData.append("perfilPicture", file);

                const token = localStorage.getItem("token");
                axios.post("http://localhost:8000/api/user/uploadImage", formData, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "multipart/form-data",
                    },
                })
                    .then(() => {
                        alert("Imagem atualizada com sucesso!");
                        this.perfilPicture = URL.createObjectURL(file);
                    })
                    .catch((error) => {
                        console.error("Erro ao enviar imagem:", error);
                        alert("Erro ao atualizar a imagem. Tente novamente.");
                    });
            }
        },

        salvarPerfil() {
            const token = localStorage.getItem("token");
            if (!token) {
                alert("Token não encontrado. Por favor, faça login novamente.");
                return;
            }

            const updatedProfile = {
                full_name: this.full_name,
                email: this.email,
                phone: this.phone.replace(/\D/g, ''),
                cep: this.cep.replace(/\D/g, ''),
                city: this.city,
                state: this.state,
                date_of_birth: this.date_of_birth,
            };

            const headers = { Authorization: `Bearer ${token}` };

            // Chama a função saveProfile passando o updatedProfile e o userId
            saveProfile(updatedProfile, this.userId)
                .then(() => {
                    alert("Perfil salvo com sucesso!");
                    this.editProfile = false; // Fecha o modal após salvar
                })
                .catch((error) => {
                    console.error("Erro ao salvar o perfil: ", error);
                    alert("Não foi possível salvar o perfil. Tente novamente.");
                });
        },


        convertToUpperCase() {
            this.full_name = this.full_name.toUpperCase();
        },
        formatPhone() {
            let cleaned = this.phone.replace(/\D/g, '');
            if (cleaned.length <= 10) {
                this.phone = cleaned.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3').trim();
            } else {
                this.phone = cleaned.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3').trim();
            }

        },
        formatCEP() {
            this.cep = this.cep.replace(/\D/g, '');
            if (this.cep.length > 5) {
                this.cep = this.cep.replace(/(\d{5})(\d{1,3})/, '$1-$2');
            }
        },
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

.profile-button:focus {
    background: #4ea1db;
    box-shadow: none;
}

.labels {
    font-size: 11px;
}

.select {
    width: 100%;
    background-color: transparent;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
    margin-bottom: 25px;
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
