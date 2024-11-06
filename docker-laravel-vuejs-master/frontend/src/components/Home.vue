<template>
    <main class="main-container">
        <div class="main-container-content">
            <h1>RRM RECRUIT</h1>
            <p>Uma plataforma de recrutamento para ajudar você empresas a encontrar seus melhores candidatos e você canditato a encontrar empresas que precisam de seus conhecimentos.</p>
        </div>
    </main>
</template>

<script>
    export default {
        name: 'Home'
    }
</script>

<style>
    .main-container-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-family: var(--font-family);
    color: var(--secondary-color);
    margin-top: 50px;
}

.main-container-content p {
    font-size: 20px;
    word-wrap:normal;
    text-align: center;
    margin: 20px 100px;
}

.main-container-content h1 {
    font-size: 46px;
    text-align: center;
}
</style>