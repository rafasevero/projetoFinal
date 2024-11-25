<template>
    <main>
        <Navbar/>
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
                        <input type="text" maxlength="14" v-model="cpf" @input="formatCPF" @blur="fetchAddress" placeholder="XXX.XXX.XXX-XX" required />
                    </div>
                    <div class="tel-container">
                        <label>Telefone</label>
                        <input type="text" maxlength="15" v-model="phone" @input="formatPhone" placeholder="(XX) XXXXX-XXXX" :maxlength="15" required />
                        <label>Data De Nascimento</label>
                        <input type="date" maxlength="10" v-model="date_of_birth" id="data" 
                        required />
                    </div>
                </div>
                <div class="email-password-container">
                    <div class="email-container">
                        <label>Seu E-mail</label>
                        <input type="email" v-model="email" id="email" required />
                    </div>
                    <div class="password-container">
                        <label>Senha</label>
                        <div class="password-input-container">
                            <input :type="showPassword ? 'text' : 'password'" v-model="password" id="senha" placeholder="Digite sua senha" required />
                            <label class="password-checkbox">
                                Mostrar Senha
                                <input type="checkbox" v-model="showPassword" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="CEP-container">
                    <label>CEP</label>
                    <input type="text" maxlength="9" v-model="cep" @input="formatCEP" @blur="fetchAddress" placeholder="XXXXX-XXX" :maxlength="9"equired />
                </div>
                <div class="address-container">
                    <div class="street-container">
                        <label>Rua</label>
                        <input type="text" v-model="address.street" placeholder="Rua" required />
                    </div>
                    <div class="neighborhood-container">
                        <label>Bairro</label>
                        <input type="text"  v-model="address.neighborhood" placeholder="Bairro" required />
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
import Notification from './Notification.vue';
import Navbar from './Navbar.vue';
export default {
    name: 'RegisterUser',
    components: {
        Notification,
        Navbar
    },
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
            showNotification: false,
            notificationMessage: ''
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

            // const dateInput = document.getElementById('data');
            // const today = new Date();
            // const minDate = new Date (today.getFulYear()-18, today.getMonth(), today.getDate());
            // const maxDate = new Date (today.getFullYear()-100, today.getMonth(), today.getDate());
            // dateInput.max = maxDate.toISOString().split('T')[0];
            // dateInput.min = minDate.toISOString().split('T')[0];
            
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
                this.notificationMessage = 'Cadastro realizado com sucesso!';
                this.showNotification = true;
                setTimeout(() => {
                    this.$router.push('/login');
                },2000);
            }
            catch(error){
                this.notificationMessage = 'Erro ao cadastrar o usuário! Tente novamente.';
                this.showNotification = true;
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
    color: #333; /* Cor um pouco mais suave */
}

#logo {
    position: absolute;
    text-align: center;
    top: 15%; /* Ajuste a posição do logo */
    font-size: 6%; /* Aumentei o tamanho do logo */
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
    background: rgba(255, 255, 255, 0.9); /* Aumentei a opacidade do fundo */
    padding: 40px; /* Aumentei o padding */
    border-radius: 15px; /* Aumentei o raio das bordas */
    width: 90%; /* Ajustei a largura para não ocupar 100% */
    max-width: 600px; /* Defini uma largura máxima */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Adicionei sombra */
    margin: auto; /* Centralizei o container */
}

form {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px; /* Aumentei o espaçamento entre os elementos */
    color: black;
}

input {
    width: 100%;
    padding: 12px; /* Aumentei o padding */
    border: 2px solid #ccc; /* Cor mais suave para a borda */
    border-radius: 25px; /* Aumentei o raio das bordas */
    font-size: 1em;
    transition: border-color 0.3s; /* Transição suave para a borda */
}

input:focus {
    border-color: #007BFF; /* Cor da borda ao focar no input */
    outline: none; /* Remover contorno padrão */
}

button {
    padding: 12px; /* Aumentei o padding */
    margin-top: 10px;
    border: 2px solid #007BFF; /* Cor da borda do botão */
    border-radius: 25px; /* Aumentei o raio das bordas */
    background-color: #007BFF; /* Cor de fundo do botão */
    color: white; /* Cor do texto do botão */
    transition: background-color 0.3s, border-color 0.3s; /* Transições suaves */
    cursor: pointer;
}

button:hover {
    background-color: #0056b3; /* Cor do botão ao passar o mouse */
    border: 2px solid #0056b3; /* Cor da borda ao passar o mouse */
}

.name-cpf-container,
.address-container,
.city-state-container {
    display: flex;
    gap: 10px; /* Aumentei o espaço entre os elementos */
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

.password-container {
    display: flex;
    flex-direction: column;
    gap: 5px; /* Espaçamento entre o label e o campo de senha */
}

.password-input-container {
    display: flex;
    align-items: center; /* Alinha verticalmente os itens no centro */
    gap: 10px; /* Espaçamento entre o input e o checkbox */
}

.password-checkbox {
    display: flex;
    align-items: center; /* Alinha o texto e o checkbox */
    font-size: 0.9em; /* Ajusta o tamanho da fonte se necessário */
}

@media (max-width: 1000px) {
    input {
        font-size: 0.9em;
    }

    button {
        padding: 10px; /* Ajuste no padding */
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
