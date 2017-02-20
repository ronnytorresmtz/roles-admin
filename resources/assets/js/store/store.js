
// store.js

const store = {

  IsUserLogged:false

};


module.exports = {

  store

};

// import Vue from 'vue';
// import Vuex from 'vuex';

// Vue.use(Vuex);

// const store = new Vuex.Store({
 
//   state: {
//     userLogged: false
//   },

//   mutations: {
//     SET_USERLOGGED(state, value){
//     	state.userLogged = value;
//     },

//   },

//   actions: {
//     setUserLogged({commit}, value) {
//       commit('SET_USERLOGGED', value);
//     }
//   },

//   getters: {
//     isUserLogged: function(state){
//      return state.userLogged;
//     }
//   }
// });

// export default new Vuex.Store({
//   state,
//   mutations,
//   actions,
//   getters
// });