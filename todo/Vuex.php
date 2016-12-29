<?php
--------------------------------
------- VUE Explanation---------
--------------------------------
// Component dispatch and Action
// Action commit a Mutation
// Mutatation mutate a State
// State render in Component
--------------------------------

// VUE STORE
const store = new Vuex.Store({
  state: {
    count: 0
  },
  mutations: {
    increment: state => state.count++,
    decrement: state => state.count--
  },
  actions: {
    increment (state) {
      state.commit('increment');
    },
    decrement (state) {
      state.commit('decrement');
    }
  }
  getters: {
    count: state => state.count;
    }
  }
})


// VUE INSTANCE

const app = new Vue({
  el: '#app',
  computed: {
    count () {
	     return store.getters.count;
    }
  },
  methods: {
    increment () {
      store.dispatch('increment');
    },
    decrement () {
    	store.dispatch('decrement');
    }
  }
 })


// HTML VIEW

<div id="app">
  <p>{{ count }}</p>
  <p>
    <button @click="increment">+</button>
    <button @click="decrement">-</button>
  </p>
</div>