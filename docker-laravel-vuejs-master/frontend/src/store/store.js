// store.js
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null, // Armazena o objeto do usuário com ID, token, etc.
    token: null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
      state.token = user.token;
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post('/api/login', credentials);
        const user = {
          id: response.data.user.id, // Pega o ID do usuário da resposta
          token: response.data.token,
          role: response.data.role,
        };
        commit('SET_USER', user);
        // Você também pode salvar o token e o ID no localStorage, se quiser manter a sessão após atualizar a página
        localStorage.setItem('user', JSON.stringify(user));
        axios.defaults.headers.common['Authorization'] = `Bearer ${user.token}`;
      } catch (error) {
        console.error('Erro ao fazer login:', error);
      }
    },
  },
  getters: {
    userId: (state) => state.user?.id,
    isAuthenticated: (state) => !!state.token,
  },
});
