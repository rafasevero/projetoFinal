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

export const ShowApply = async () => {
  try {
    // Faz a requisição para buscar as candidaturas do usuário autenticado
    const response = await axios.get('http://localhost:8000/api/user/getVacanciesForUser'); // Certifique-se de que o URL esteja correto
    return response.data; // Retorna os dados da resposta
  } catch (error) {
    console.error("Erro ao buscar as candidaturas:", error);
    throw error;
  }
};
