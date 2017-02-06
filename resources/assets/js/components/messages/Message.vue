<style scope>
.message-padding{

  padding-top: 20px;
  padding-bottom: 20px;

}
</style>

<template>
  <div>
    <p class="bg-{{color}} message-padding" align="{{align}}">
        {{ ts[message] }}
    </p>
  </div>
</template>

<script>

  import MyLang from '../../components/languages/Languages.vue';


  module.exports = {

    mixins: [MyLang],

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