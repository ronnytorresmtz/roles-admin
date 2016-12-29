<style scoped>
  
</style>

<template>
  <div>
    <a :href="url" title="{{title}}" @click.prevent="clickIcon"> <i class="{{icon}}"></i> {{text}} </a>
  </div>
</template>

<script>
  module.exports = {

    props: ['icon', 'url', 'text', 'title'],

    mounted: function(){

    },

    data: function() {
      return {
       
      }
    },

    methods: {

     clickIcon: function () {
        alert ('click Icon');
      }
      
    },
  }
</script>