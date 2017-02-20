<style scoped></style>

<template></template>

<script>

import MyLang from '../languages/Traslations.vue';

module.exports = {

    ready: function(){
      this.ts= this.getLang();
    },

    data: function(){
      return {
        ts: '',
        locale: 'en',
      }
    },

    methods:{

      getLang: function(){
        return MyLang[this.locale];
      },
      
      setLocale: function(e){
        this.locale= e.target.value;
        this.ts= this.getLang();
        
      }
     
    }
    
  }

</script>