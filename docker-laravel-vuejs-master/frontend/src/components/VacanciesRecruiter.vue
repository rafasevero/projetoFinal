<template>
    <div class="container">
        <h1>Minhas Vagas</h1>
        <button>Cadastrar nova vaga</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            searchQuery: '', // Guarda o valor da pesquisa
            vagas: [] // Armazena as vagas carregadas da API
        };
    },
    computed: {
        filteredVagas() {
            // Filtra as vagas de acordo com o valor da pesquisa
            return this.vagas.filter(vaga =>
                vaga.titulo.toLowerCase().includes(this.searchQuery.toLowerCase())
            );
        }
    },
    methods: {
        async fetchVagas() {
            try {
                const response = await axios.get('http://localhost:8000/api/vagas');
                this.vagas = response.data;
            } catch (error) {
                console.error('Erro ao buscar vagas:', error);
            }
        }
    },
    mounted() {
        this.fetchVagas(); // Busca as vagas quando o componente é montado
    }
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}

h1 {
  font-size: 24px;
  margin-bottom: 25px;
  text-align: center;
}

button {
  background-color: #4ea1db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  border: 1px solid #4ea1db;
  cursor: pointer;
  margin: 0 auto;
  
}

button:hover {
  background-color: #ffffff;
  color: #4ea1db;
  border: 1px solid #4ea1db;
  transition: 0.5s;
}


@media (max-width: 768px) {
  h1 {
    font-size: 20px;
  }
  
  input {
    font-size: 14px;
    padding: 6px;
  }
  
  li {
    font-size: 16px;
    padding: 8px;
  }
}

@media (max-width: 480px) {
  h1 {
    font-size: 18px;
    margin-bottom: 15px;
  }

  input {
    padding: 6px;
    font-size: 14px;
  }

  li {
    font-size: 14px;
    padding: 6px;
  }
}
</style>