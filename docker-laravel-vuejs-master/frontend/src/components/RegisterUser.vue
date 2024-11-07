<template>
    <main>
        <header>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        </header>
        <a href="/register"><i class='bx bx-arrow-back'></i></a>
        <div class="back">
            <img id="fundo" src="../assets/fundo.jpg" alt="Fundo" />
            <img id="logo" src="../assets/logo-sem-fundo-2.png" alt="" />
        </div>
        <div class="candidato">
            <form @submit.prevent="submitForm">
                <h1>Registrar Candidato</h1>
                <div class="name-cpf-container">
                    <div class="name-container">
                        <label>Seu Nome Completo</label>
                        <input type="text" v-model="full_name" id="nome" required />
                        <label>CPF</label>
                        <input type="text" v-model="cpf" @input="formatCPF" @blur="fetchAddress" placeholder="XXX.XXX.XXX-XX" required />
                    </div>
                    <div class="tel-container">
                        <label>Telefone</label>
                        <input type="text"  v-model="phone" @input="formatPhone" placeholder="(XX) XXXXX-XXXX" required />
                        <label>Data De Nascimento</label>
                        <input type="date" v-model="date_of_birth" id="data" required />
                    </div>
                </div>
                <div class="email-password-container">
                    <div class="email-container">
                        <label>Seu E-mail</label>
                        <input type="email" v-model="email" id="email" required />
                    </div>
                    <div class="password-container">
                        <label>Senha</label>
                        <input  :type="showPassword ? 'text' : 'password'" v-model="password" id="senha" placeholder="Digite sua senha" required />
                        <label class="password-checkbox">
                            Mostrar Senha
                            <input type="checkbox" v-model="showPassword" />
                        </label>
                    </div>
                </div>
                <div class="CEP-container">
                    <label>CEP</label>
                    <input type="text" v-model="cep" @input="formatCEP" @blur="fetchAddress" placeholder="XXXXX-XXX" required />
                </div>
                <div class="address-container">
                    <div class="street-container">
                        <label>Rua</label>
                        <input type="text" v-model="address.street" placeholder="Rua" required />
                    </div>
                    <div class="neighborhood-container">
                        <label>Bairro</label>
                        <input type="text" v-model="address.neighborhood" placeholder="Bairro" required />
                    </div>
                </div>
                <div class="city-state-container">
                    <div class="city-container">
                        <label>Cidade</label>
                        <input type="text" v-model="address.city" placeholder="Cidade" required />
                    </div>
                    <div class="state-container">
                        <label>Estado</label>
                        <input type="text" v-model="address.state" placeholder="Estado" required />
                    </div>
                </div>
                <button id="cadastrar">Cadastrar</button>
            </form>
        </div>
    </main>
</template>

<script>
import axios from 'axios';
import { registerUser } from '../services/RegisterUser';
export default {
    name: 'RegisterUser',
    data() {
        return {
            full_name:'',
            cpf: '',
            phone: '',
            date_of_birth:'',
            email:'',
            password: '',
            showPassword: false,
            cep: '',
            address: {
                street: '',
                neighborhood: '',
                city: '',
                state: '',
            },
        };
    },
    methods: {
        formatCPF() {
            this.cpf = this.cpf
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        },

        formatPhone() {
            let cleaned = this.phone.replace(/\D/g, '');
            if (cleaned.length <= 10) {
                this.phone = cleaned.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3').trim();
            } else {
                this.phone = cleaned.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3').trim();
            }
        },

        async fetchAddress() {
            const cleanedCep = this.cep.replace(/\D/g, '');
            if (cleanedCep.length === 8) {
                try {
                    const response = await axios.get(`https://viacep.com.br/ws/${cleanedCep}/json/`);
                    if (response.data && !response.data.erro) {
                        this.address.street = response.data.logradouro;
                        this.address.neighborhood = response.data.bairro;
                        this.address.city = response.data.localidade;
                        this.address.state = response.data.uf;
                    } else {
                        alert('CEP não encontrado. Verifique se o CEP está correto.');
                    }
                } catch (error) {
                    console.error('Erro ao buscar endereço:', error);
                    alert('Ocorreu um erro ao buscar o endereço. Tente novamente mais tarde.');
                }
            }
        },

        formatCEP() {
            this.cep = this.cep.replace(/\D/g, '');
            if (this.cep.length > 5) {
                this.cep = this.cep.replace(/(\d{5})(\d{1,3})/, '$1-$2');
            }
        },
        async submitForm(){
            this.loading = true
            const cleanedCPF = this.cpf.replace(/\D/g, '')
            const cleanedPhone = this.phone.replace(/\D/g, '')
            const cleanedCep = this.cep.replace(/\D/g, '')
            
            const dataToSend = {
                full_name: this.full_name,
                cpf: cleanedCPF,
                phone: cleanedPhone,
                date_of_birth: this.date_of_birth,
                email: this.email,
                password: this.password,
                cep: cleanedCep,
                city: this.address.city,
                state: this.address.state,
                is_recruiter: false,
            }
            
            try{
                await registerUser(dataToSend)
                this.$router.push('/')
            }
            catch(error){
                console.error('Erro ao cadastrar o usuário:', error)
            }

        },
    }
}
</script>

<style scoped>
/* Estilos gerais */
* {
    font-family: 'Inter', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.bx-arrow-back {
    font-size: 5vh;
    color: black;
}

#logo {
    position: absolute;
    text-align: center;
    top: 20%;
    font-size: 5%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: -1;
}

#fundo {
    position: absolute;
    width: 100%;
    height: 120vh;
    object-fit: cover;
    z-index: -1;
}

.candidato {
    position: relative;
    background: rgba(255, 255, 255, 0.8);
    padding: 30px;
    border-radius: 10px;
    width: 100%;
}

form {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 15px;
    color: black;
}

input {
    width: 100%;
    padding: 10px;
    border: 2px solid black;
    border-radius: 20px;
    font-size: 1em;
}

button {
    padding: 10px;
    margin-top: 10px;
    border: 2px solid black;
    border-radius: 5px;
    background-color: transparent;
    transition: 0.3s;
    cursor: pointer;
}

button:hover {
    color: white;
    background-color: #31312f;
    border: 2px solid white;
}

.name-cpf-container,
.address-container,
.city-state-container {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.name-container,
.tel-container,
.CEP-container,
.street-container,
.neighborhood-container,
.city-container,
.state-container,
.email-container,
.password-container {
    flex: 1;
}

@media (max-width: 1000px) {
    input {
        font-size: 0.9em;
    }

    button {
        padding: 8px;
        font-size: 0.9em;
    }
}

@media (max-width: 600px) {
    .name-cpf-container,
    .address-container,
    .city-state-container {
        flex-direction: column;
    }
}
</style>
