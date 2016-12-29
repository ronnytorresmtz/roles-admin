
/*var forms= '<div><div class="panel panel-default">'
                '<div class="panel-heading">' +
                  '<h3 class="panel-title">ADD </h3>'+
                '</div>'          
                '<div class="panel-body body-height"> HOLA </div>'+
            '</div></div>';*/

var forms= '<br><div class="panel panel-default" >  <div class="panel-heading"> <h3 class="panel-title">TEST </h3> </div> <div class="panel-body body-height" style="padding:10px"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis in ratione aspernatur sequi est, perferendis eaque dolorem! Consequuntur vel praesentium magni a consequatur velit, dignissimos delectus ipsa quam aut recusandae.<br> <br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, minus, odit. Sint, aperiam. Eligendi distinctio, numquam temporibus, laboriosam reiciendis animi eos, nam inventore impedit tempore minus explicabo? Autem, asperiores, nam.<br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis natus saepe, eum ea vitae facere velit fugit, earum, r </div> <a class="btn btn-sm btn-primary" @click.prevent="close" > Close </a> </div>'

Vue.component('myform', {

  template: forms,
 
  props: ['message'],

    data: function() {
      return {
        type: 0
      }
    },

    methods: {

      close: function(){
        this.$dispatch('activeCrud', false);
      }
     
    }
   
});
