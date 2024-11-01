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
                    <button id="cadastrar">Candidato</button>
                    <p>ou</p>
                    <button id="cadastrar">Empresa</button>
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