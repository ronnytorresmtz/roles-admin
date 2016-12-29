<style scope>
.overlay{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 0;
  height: 2px;
}

</style>

<template>

  <div class="overlay progress" v-show="progressbar">
    <div 
        class="progress-bar progress-bar-info active" 
        aria-valuemin="0" 
        aria-valuemax="100" 
        :style="'width: ' + progress + '%'">
    </div>
  </div>
  

</template>

<script>
  module.exports = {
    
    data: function() {
      return {
        progress: 0,
        progressbar: true,
      }
    },

    mounted: function() {
      //this.start();
      //this.finish();
    },

    methods: {

      start: function(){
        var self=this;
        this.progress = 0;
        self.progressbar=true;
        var timerId=setInterval(function(){
          self.progress=self.progress+1;
          if (self.progress==95) {
            clearInterval(timerId);
          }
        }, 100);
      },

      finish: function(){
        var self=this;

        var timerId=setInterval(function(){
            self.progressbar=false;
            clearInterval(timerId);
        }, 5000);
      },
    
    },

    events:{

      progressStart: function(){
        this.start();
      },

      progressFinish: function(){
        this.finish();
      }


    }
   
  }
</script>