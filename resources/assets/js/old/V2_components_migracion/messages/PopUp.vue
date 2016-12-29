<style scope>

  .popup {
    position: relative;
  }

  .popup-position {
    padding: 15px;
    position: absolute;
    border: 1px solid transparent;
    border-radius: 4px;
    width: 500px;
    margin: auto; 
    left:0px;
    right: 0px;
    top: -30px;    
    text-align: center;
    z-index: 1;
    padding: 20px;
  }

  .popup-info{
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
  }

  .popup-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
  }

  .popup-warning {
    color: #8a6d3b;
    background-color: #fcf8e3;
    border-color: #faebcc;
  }

  .popup-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
  }

  .popup-close{
    position: absolute;
    margin-right: 10px;
    right: 0;
    top: 0;
    cursor: pointer;
    font-size: x-large;

  }

  .center{
    margin: 0 auto;
  }

</style>

<template>
  <div class="popup"> 
    <div class="'popup-position popup-' + type" v-show="showAlert" >
       {{message}} 
        <span class="popup-close" v-show="showAlert" @click="hideBoxMessage"> &times; </span>
    </div>
  </div>
</template>

<script>
  module.exports = {
    
    data: function() {
      return {
        showAlert: false,
        displayByTime: true,
        type:'',
        message:''
      }
    },
    mounted: function() {
      this.hideBoxMessageByTime();
    },

    methods: {

      hideBoxMessage: function(){
        this.showAlert = false;      
      },

      hideBoxMessageByTime:function(){
        if (this.type=='success'){
          var self=this;
          setTimeout(function(){
            self.showAlert = false;
          }, 3000);
        }
      }

    },

    events: {
      displayBoxMessage: function(type, message){
        this.showAlert=true;   
        this.type=type;
        this.message=message;
        this.hideBoxMessageByTime();
      },
    }
    
  }
</script>