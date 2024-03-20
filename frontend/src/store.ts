import { createStore } from 'vuex';
import type {MutationTree, ActionTree} from 'vuex'

interface TokenStateInterface {
  token: string | null;
}

const store = createStore({
  state: {
    token: localStorage.getItem('token') || null,
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
      // Atualize o token no localStorage
      localStorage.setItem('token', token);
    },
    clearToken(state) {
      state.token = null;
      // Remova o token do localStorage
      localStorage.removeItem('token');
    },
  },
  actions: {
    // Sua lógica de login que chama a mutação setToken
    login({ commit }, token) {
      commit('setToken', token);
    },
    // Sua lógica de logout que chama a mutação clearToken
    logout({ commit }) {
      commit('clearToken');
    },
  },
});

export default store;
