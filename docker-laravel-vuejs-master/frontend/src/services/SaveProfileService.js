import axios from 'axios';

const API_URL = 'http://localhost:8000/api'; // Base da sua API

const UserService = {
    /**
     * Obtém os dados do perfil do usuário.
     * @param {string} token - Token JWT para autenticação.
     * @returns {Promise} - Dados do perfil do usuário.
     */
    getUserProfile(token) {
        return axios.get(`${API_URL}/user/profile`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
    },

    /**
     * Salva as alterações do perfil do usuário.
     * @param {Object} profileData - Dados atualizados do perfil.
     * @param {string} token - Token JWT para autenticação.
     * @returns {Promise} - Resposta da API.
     */
    saveUserProfile(profileData, token) {
        return axios.put(`${API_URL}/user/profile`, profileData, {
            headers: {
                Authorization: `Bearer ${token}`,
                'Content-Type': 'application/json',
            },
        });
    },
};

export default UserService;
