import axios from 'axios';

// Adiciona um interceptor para incluir o token de autenticação nas requisições
axios.interceptors.request.use(config => {
  const token = localStorage.getItem("token"); // Recupera o token do localStorage
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`; // Inclui o token no cabeçalho Authorization
  }
  return config;
}, error => {
  return Promise.reject(error);
});

export const ShowVagas = async () => {
  try {
    // Faz a requisição para buscar as vagas
    const response = await axios.get('http://localhost:8000/api/getVacancies');
    return response.data; // Retorna as vagas
  } catch (error) {
    console.error("Erro ao buscar as vagas:", error);
    throw error;
  }
};
