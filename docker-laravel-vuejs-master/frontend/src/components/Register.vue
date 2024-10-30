<template>
    <main>
        <header>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        </header>
        <a href="Home.vue"><i class='bx bx-arrow-back'></i></a>
        <div class="back">
            <img id="fundo" src="../assets/fundo.jpg" alt="Fundo">
            <img id="logo" src="../assets/logo-sem-fundo-2.png" alt="">
        </div>
        <div class="container">
            <div class="candidato">
                <form>
                    <h1>Registrar Candidato</h1>
                    <div class="name-cep-container"> <!-- Contêiner para Nome e CEP -->
                        <div class="name-container">
                            <label>Seu Nome Completo</label>
                            <input type="text" name="full_name" id="nome" required />
                        </div>
                        <div class="cep-container">
                            <label>CEP</label>
                            <input type="text" v-model="cep" @blur="fetchAddress" placeholder="XXXXX-XXX" required />
                        </div>
                    </div>

                    <div class="dob-phone-container"> <!-- Contêiner para Data de Nascimento e Telefone -->
                        <div class="dob-container">
                            <label>Sua Data De Nascimento</label>
                            <input type="date" name="date_of_birth" id="data" required />
                        </div>
                        <div class="phone-container">
                            <label>Telefone</label>
                            <input type="text" name="phone" v-model="phone" @input="formatPhone" placeholder="(XX) XXXXX-XXXX" required />
                        </div>
                    </div>

                    <div class="email-password-container"> <!-- Contêiner para E-mail e Senha -->
                        <div class="email-container">
                            <label>Seu E-mail</label>
                            <input type="email" name="email" id="email" required />
                        </div>
                        <div class="password-container">
                            <label>Senha</label>
                            <input name="password" :type="showPassword ? 'text' : 'password'" v-model="password" id="senha" placeholder="Digite sua senha" required />
                            <label class="password-checkbox">
                                Mostrar Senha
                                <input type="checkbox" v-model="showPassword" />
                            </label>
                        </div>
                    </div>

                    <div class="address-container"> <!-- Contêiner para os campos de endereço -->
                        <div class="street-container">
                            <label>Rua</label>
                            <input type="text" v-model="address.street" placeholder="Rua" required />
                        </div>
                        <div class="neighborhood-container">
                            <label>Bairro</label>
                            <input type="text" v-model="address.neighborhood" placeholder="Bairro" required />
                        </div>
                    </div>

                    <div class="city-state-container"> <!-- Contêiner para Cidade e Estado -->
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
            <div class="empresa">
                <form class="empresa">
                    <h1>Registrar Empresa</h1>
                    <label>Seu E-mail</label>
                    <input type="text" name="email" id="email" required /> <!-- Campo de e-mail -->
                    <label>Sua Senha</label>
                    <input type="password" name="senha" id="senha" required /> <!-- Campo de senha -->
                    <button>LOGAR</button>
                    <p>Não tem conta?<br>Cadastre-se Aqui!!</p>
                    <button id="cadastrar">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</template>



<script>
import axios from 'axios';
export default {
    name: 'Register',
    data(){
        return{
            cpf: '',
            phone:'',
            cep: '',
            address: {
                street: '',
                neighborhood: '',
                city: '',
                state: '',
            },
            password: '',
            showPassword: false,
        };
    },
    methods: {

        formatCPF(cpf) {
            
            cpf = cpf.replace(/\D/g, '');

        
            if (cpf.length <= 11) {
                if (cpf.length < 4) return cpf; 
                if (cpf.length < 7) return cpf.replace(/(\d{3})(\d+)/, '$1.$2');
                if (cpf.length < 10) return cpf.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3'); 
                return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d+)/, '$1.$2.$3-$4'); 
            } else {
                return cpf; 
            }
        },

        formatPhone() {
            // Remove caracteres que não são números
            let cleaned = this.phone.replace(/\D/g, '');

            // Aplica a máscara
            if (cleaned.length <= 10) {
                // (XX) XXXX-XXXX
                this.phone = cleaned.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3').trim();
            } else {
                // (XX) XXXXX-XXXX
                this.phone = cleaned.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3').trim();
            }
        },

        async fetchAddress() {
            // Remove caracteres não numéricos do CEP
            const cleanedCep = this.cep.replace(/\D/g, '');
            if (cleanedCep.length === 8) {
                try {
                    // Corrigir a construção da URL
                    const response = await axios.get(`https://viacep.com.br/ws/${cleanedCep}/json/`);
                    if (response.data && !response.data.erro) {
                        this.address.street = response.data.logradouro;
                        this.address.neighborhood = response.data.bairro;
                        this.address.city = response.data.localidade;
                        this.address.state = response.data.uf;
                    } else {
                        alert('CEP não encontrado.');
                    }
                } catch (error) {
                    console.error('Erro ao buscar endereço:', error);
                    alert('Erro ao buscar endereço. Verifique o CEP e tente novamente.');
                }
            } else {
                alert('Por favor, insira um CEP válido.');
            }
        }
    }
}

</script>

<style scoped>
.candidato {
    position: relative;
}

* {
    font-family: 'Inter';
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
    height: 100vh;
    object-fit: cover;
    z-index: -1;
}

.container {
    display: flex;
    height: 100vh;
    padding: 15px;
    flex-wrap: wrap; /* Permite que os elementos se movam para a linha seguinte */
    display: flex;
    justify-content: center;
    align-items: center;
}

.candidato,
.empresa {
    background: rgba(255, 255, 255, 0.8);
    padding: 30px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin: 10px;
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

p {
    text-align: center;
}

.password-container {
    display: flex;
    flex-direction: column; /* Mantém a coluna para o input de senha */
    gap: 5px; /* Espaçamento reduzido entre o input e checkbox */
}

.password-checkbox {
    display: flex; /* Flex para colocar checkbox e texto na mesma linha */
    align-items: center; /* Alinha checkbox e texto verticalmente */
    gap: 5px; /* Espaçamento entre o texto e a checkbox */
}

.name-cep-container,
.dob-phone-container,
.address-container,
.city-state-container {
    display: flex; /* Usar flexbox para alinhar os campos lado a lado */
    gap: 15px; /* Espaçamento entre os campos */
    flex-wrap: wrap; /* Permite que os campos se movam para a linha seguinte em telas pequenas */
}

.name-container,
.cep-container,
.dob-container,
.phone-container,
.street-container,
.neighborhood-container,
.city-container,
.state-container,
.email-container,
.password-container {
    flex: 1; /* Todos os campos vão ocupar a mesma quantidade de espaço */
}

@media (max-width: 768px) {
    .candidato,
    .empresa {
        max-width: 100%; /* Permite que as caixas ocupem 100% da largura em dispositivos menores */
    }

    input {
        font-size: 0.9em;
    }

    button {
        padding: 8px;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 1.5em;
    }

    input {
        padding: 8px;
        font-size: 0.8em;
    }

    button {
        padding: 8px;
    }

    #fundo {
        height: 100%;
    }
}
</style>

