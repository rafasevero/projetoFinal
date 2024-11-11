<template>
    <main>
        <header>
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        </header>
        <router-link to="/"><i class='bx bx-arrow-back'></i></router-link>
        <div class="back">
            <img id="fundo" src="../assets/fundo.jpg" alt="Fundo">
            <img id="logo" src="../assets/logo-sem-fundo-2.png" alt="">
        </div>
        <div>
            <Notification v-if="showNotification" :message="notificationMessage" />    
        </div>
        <div class="conteiner">
            <div class="caixa">
                <form @submit.prevent="formLogin">
                    <h1>Login</h1>
                    
                    <label for="email">Seu E-mail</label>
                    <input type="email" name="email" id="email" v-model="email" required>
                    <span v-if="errors.email">{{ errors.email }}</span>
                    
                    <label for="password">Sua Senha</label>
                    <input type="password" name="password" id="password" v-model="password" required>
                    <span v-if="errors.password">{{ errors.password }}</span>
                    
                    <button type="submit">LOGAR</button>
                    
                    <p>Não tem conta?<br>Cadastre-se Aqui!!</p>

                    <router-link to="/register">
                        <button id="cadastrar">Cadastrar</button>
                    </router-link>
                </form>
            </div>
        </div>
    </main>
</template>

<script>
import { login } from '@/services/Loginservice';
import Notification from './Notification.vue';

export default {
    name: 'Login',
    components: {
        Notification
    },
    data() {
        return {
            email: "",
            password: "",
            errors: {
                email: "",
                password: ""
            },
            showNotification: false,
            notificationMessage: ''
        };
    },
    methods: {
        validateForm() {
            this.errors.email = "";
            this.errors.password = "";

            if (!this.email) {
                this.errors.email = "Por favor, insira um e-mail válido";
            } else if (!this.validEmail(this.email)) {
                this.errors.email = "E-mail no formato inválido";
            }
            if (!this.password) {
                this.errors.password = "Por favor, insira uma senha válida";
            }

            return !this.errors.email && !this.errors.password;
        },
        validEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        },
        async formLogin() {
            try {
            const user = await login(this.email, this.password);
                console.log(user);
            if (user.role === "user") {
                
                this.notificationMessage = 'Login efetuado com sucesso!';
                this.showNotification = true;
                setTimeout(() => {
                    this.$router.push('/vagas');
                },2000);

                
            } else if (user.role === "recruiter") {
                this.$router.push('/contato');
                this.notificationMessage = 'Login efetuado com sucesso!';
                this.showNotification = true;
                setTimeout(() => {
                    this.$router.push('/contato');
                },2000);
            }
            } catch (error) {
                alert('Email e/ou Senha inválidos!');
            }

        },


        goToRegister() {
            window.location.href = 'registerUser'; // Redireciona para a página de registro
        }
    }
}


</script>

<style scoped>
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

.conteiner {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 15px;
}


.caixa {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.8);
    padding: 30px;
    border-radius: 10px;
    width: 100%;
    max-width: 400px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
    padding: 10px 130px;
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

@media (max-width: 768px) {
    .caixa {
        padding: 20px;
    }

    input {
        font-size: 0.9em;
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

    #fundo {
        height: 100%;
    }
}
</style>
