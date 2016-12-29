// store.js

import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
 
  state: {
    showForm: false
  },

  mutations: {
    TOGGLE_FORM(state){
    	state.showForm = ! state.showForm
    },

  },

  actions: {
    toggleForm({commit}) {
      commit('TOGGLE_FORM')
    }
  },

  getters: {
    getShowForm: function(state){
     return state.showForm;
    }
  }
});

export default new Vuex.Store({
  state,
  mutations,
  actions,
  getters
});