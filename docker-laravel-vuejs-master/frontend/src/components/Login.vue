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
        <div class="conteiner">
            <div class="caixa">
                <form>
                    <h1>Login</h1>
                    <label>Seu E-mail</label>
                    <input type="email" name="email" id="email" required>
                    <label>Sua Senha</label>
                    <input type="password" name="senha" id="senha" required>
                    <button>LOGAR</button>
                    <p>Não tem conta?<br>Cadastre-se Aqui!!</p>
                    <button><a href="registerUser">Cadastrar</a></button>
                </form>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Login'
}
</script>

<style scoped>

* {
    font-family: 'Inter';
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.bx-arrow-back{
    font-size: 5vh;
    color: black;
}
#logo{
    position: absolute;
    text-align: center;
    top: 20%;
    font-size: 5%;
    left: 50%;
    transform: translate(-50%,-50%);
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
    padding:  15px; 
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

@media (max-width: 768px) {
    .caixa {
        padding: 20px;
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
