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
        <div class="conteiner">
            <div class="caixa">
                <form>
                    <h1>Como você quer se cadastrar?</h1>
                    <router-link to="/candidateRegister">
                        <button id="cadastrar">Candidato</button>
                    </router-link>
                    <p>ou</p>
                    <router-link to="/recruiterRegister">
                        <button id="cadastrar">Empresa</button>
                    </router-link>
                </form>
            </div>
        </div>
    </main>
</template>
<script>
export default{
    name:'Register'
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
    text-align: center;
}


button {
    padding: 10px 120px;
    margin-top: 10px;
    border: 2px solid black;
    border-radius: 5px;
    background-color: transparent;
    transition: 0.3s;
    cursor: pointer;
    text-decoration: none;
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
