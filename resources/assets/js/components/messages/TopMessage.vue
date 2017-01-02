<style scope>

</style>

<template>
    <p class="bg-{{color}}" align="{{align}}">
      <br>
        {{message}}
      <br><br>
    </p>
</template>

<script>
  module.exports = {

    props: ['message', 'color', 'align'],
    
    data: function() {
      return {
       
      }
    },

    ready: function() {
     
    },

    methods: {
     

    },
   

  }
  
</script>