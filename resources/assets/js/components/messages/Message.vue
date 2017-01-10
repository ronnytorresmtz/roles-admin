<style scope>
.message-padding{

  padding-top: 20px;
  padding-bottom: 20px;

}
</style>

<template>
  <div>
    <p class="bg-{{color}} message-padding" align="{{align}}">
        {{message}}
    </p>
  </div>
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