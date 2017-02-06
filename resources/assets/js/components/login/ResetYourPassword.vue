<style scoped>
 a{
    cursor: pointer;
  }
  .confirm-password{
    color:red;
    font-size: 12px;
    font-style:italic;
  }
  .component-center{
      display: block;
      margin-top: 50px;
  }
 
</style>

<template>
  <div class="panel panel-default component-center" v-if="showView">
    <div class="panel-heading">
      <h3 class="panel-title">{{ ts['resetYourPassword'] }} </h3>
    </div>           
    <div class="panel-body">

      <form>
          <div class="row">
            <div class="col-sm-12 text-left">
              <p class="alert alert-info">
                {{ ts['securtiyNumberMsg'] }}
                
                
              </p>
               {{ ts['securityNumber'] }}
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  <i class="glyphicon glyphicon-lock" ></i>
                </span>			
                <input 
                  v-model="securityNumber"
                  class="form-control"
                  type="" 
                  name="remember_security_number" 
                  value=""
                  size="10px"
                  aria-describedby="basic-addon1"
                  placeholder="{{ ts['typeTheSecurityNumber']}}">
                </input>
              </div>
              
              <hr>
               {{ ts['newPassword'] }}
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  <i class="glyphicon glyphicon-lock" ></i>
                </span>			
                <input 	
                    v-model="password"
                    type="password" 
                    name="new_password" 
                    class ="form-control",
                    maxlength="15",
                    placeholder="{{ ts['typeTheNewPassword'] }}">
                </input>
              </div>

              <span v-show="lengthMessage" class="confirm-password">{{ ts['newPasswordError'] }}</span>

              <br>
             {{ ts['confirmPassword'] }}
              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                  <i class="glyphicon glyphicon-lock" ></i>
                </span>			

                <input 	type="password"
                    v-model="confirmPassword"
                    name="new_password_confirmation" 
                    class ="form-control",
                    maxlength="15",
                    placeholder="{{ ts['typeTheConfirmPassword'] }}">
                </input>
              </div>
             
              <span v-show="confirmMessage" class="confirm-password">{{ ts['confirmPasswordError'] }}</span>
              
            </div>
          </div>

          <hr>

          <div class="control-group" align="right" >
            <button 
              class="btn btn-sm btn-primary"
              style="width:100px"
              @click.prevent="resetPassword"
              :disabled="(confirmMessage) ? true : false"
            >
            {{ ts['reset'] }}
            </button>
          </div>	
      </form>
    </div>
  </div>

</template>

<script>

  import MyLang from '../../components/languages/Languages.vue';

  module.exports = {

   mixins: [MyLang],

    beforeCompile: function(){
      var self=this;
      self.$http.post('login/tokenExist', {token: self.$route.query.token}).then(function(response){
          if (response.data==true){
            self.showView = true;
            self.token = self.$route.query.token;
          }else{
            self.showView = false;
            self.$dispatch('displayAlert', 'danger', 'Not Authorized (401)');
          }
      }).catch(function (response) {
          self.showView = false;
          self.displayPopUpMessage(response);
      });

    },

    ready: function(){
    },

    data: function() {
      return {
        loading:false,
        securityNumber:'',
        password:'',
        token:'',
        confirmPassword:'',
        confirmMessage:'',
        lengthMessage:'',
        showView: false,
      }
    },


    methods: {

      resetPassword: function(){
        var self=this;
        self.loading = true;
        self.$http.post(
          'login/resetYourPassword', 
          {
            token: self.token,
            security_number: self.securityNumber, 
            new_password: self.password
          }
        ).then(function(response){
          if (!response.data.error){
            self.$route.router.go('/login');
          }else{
            self.loading = false;
            self.$dispatch('displayAlert',  'danger', response.statusText);
          }
        }).catch(function (response) {
          self.loading = false;
          self.displayPopUpMessage(response);
        });
      },

      displayPopUpMessage: function(response){
        this.$dispatch('displayAlert', (response.status==200) ? 'success' : 'danger', response.data + ' (' + response.status + ')');
      },
    },

     watch: {

      'password': function(){
          this.confirmMessage = (this.password == this.confirmPassword || !this.password) ? false : true;
          this.lengthMessage = (this.password.length >= 8 || !this.password) ? false : true;
      },

      'confirmPassword': function(){
          this.confirmMessage = (this.password == this.confirmPassword || !this.password)  ? false : true;
      },

     }

  }

</script>