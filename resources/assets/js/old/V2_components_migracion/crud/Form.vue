<style scoped>
  .button-size{
    width:70px;
    margin-left:10px;
    margin-bottom:10px;
  }

  .body-height{
    height: auto;
  }

  .align-button{
    margin: auto;
  }

  .expand-botton{
    padding: 4px;
  }

  .lg-red{
    color: red;
    font-size: large;
  }

  textarea {
    resize: none;
  }

  input, select, textarea, i {
    margin-bottom: 10px;
  }

  .processing{
    padding-left:10px;
    padding-bottom:20px;
    color: blue;
  }
</style>

<template>

  <div>
    <div class="panel panel-default" > 
      <div class="pull-right expand-botton">
        <button class="btn btn-xs btn-default expand-botton" @click.prevent="expand" v-text="expandOrCollapse">
       <!--i class="glyphicon glyphicon-align-justify" ></i-->
        </button>
      </div>
      <div class="panel-heading">
        <h3 class="panel-title">{{actionType}} {{formTitle}}</h3>
      </div>  
   
      <div class="panel-body body-height"> 

        <div v-for="field in fields"> 
          <div class="row">

            <div class="col-sm-12 text-left" v-if="(field.type=='text')">
              <div class="control-group">
                <b>{{field.label}}:</b> <span class="lg-red" v-text="field.required && !field.value ? ' *' : ''"></span>
                <span >
                  <input 
                    type="text"
                    v-model="field.value"
                    name="field.name"
                    :maxlength="field.maxlength"
                    :placeholder="field.placeholder"
                    :readonly="field.readonly"
                    :required="field.required"
                    class="form-control"
                    @keyup="validFieldsRequired"> 
                  </input>
                </span>
              </div>
            </div>
            
              <div class="col-sm-12 text-left" v-if="(field.type=='textarea')">
                <div class="control-group">
                  <b>{{field.label}}:</b> <span class="lg-red" v-text="field.required && !field.value ? ' *' : ''"></span>
                  <span >
                    <textarea 
                        v-model="field.value"
                        name="field.name"
                        :maxlength="field.maxlength"
                        :placeholder="field.placeholder"
                        :readonly="field.readonly"
                        :required="field.required"
                        class="form-control"
                        @keyup="validFieldsRequired"> 
                    </textarea>
                  </span>
                </div>
              </div>
            
              <div class="col-sm-12 text-left" v-if="(field.type=='checkbox')">
                <div class="control-group"> 
                  <b>{{field.label}}:</b>  
                  <input 
                    type="checkbox" 
                    v-model="field.value"
                    name="field.name"
                    :maxlength="field.maxlength" 
                    :placeholder="field.placeholder" 
                    :checked="field.checked" 
                    :readonly="field.readonly"
                    :required="field.required"
                    @change="validFieldsRequired"> 
                  </input>
                </div>
              </div>

             <div class="col-sm-12 text-left" v-if="(field.type=='select')">
              <div class="control-group"> 
                <b>{{field.label}}:</b> 
                <select 
                  :id="field.name"
                  class="form-control"
                  name="field.name" 
                  :required="field.required"
                  :disabled="field.readonly" 
                  @change="validSelect($event, field)">
                  <option 
                    v-for="op in getFieldName(field.table)"
                    :selected="op.selected" 
                    :value="op.id"
                    :label="op.value"
                    >
                  </option>
                </select>
              </div>
            </div>

            <div class="col-sm-12 text-left" v-if="(field.type=='status' && actionType!='Add')" >
              <div class="control-group"> 
                <b>{{field.label}}:</b>  
                <span >
                  <i :class="'glyphicon glyphicon-' + itemStatus" name="deleted_at"></i>
                </span>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="row text-left align-button">
        <button class="btn btn-sm btn-success button-size" v-show="displayBtnSave" :disabled="isDisableBtnSave" @click.prevent="btnSave" > Save </button> 
        <button class="btn btn-sm btn-success button-size" v-show="displayBtnUpdate" :disabled="isDisableBtnUpdate" @click.prevent="btnUpdate" > Update </a> 
        <button class="btn btn-sm btn-danger button-size" v-show="displayBtnDelete" @click.prevent="btnDelete" > Delete </button>
        <!-- <button class="btn btn-sm btn-success button-size" v-show="displayBtnReset" @click.prevent="btnReset" > Reset </button> -->
        <button class="btn btn-sm btn-success button-size" v-show="displayBtnExport" @click.prevent="btnExport" > Export </button>
        <button class="btn btn-sm btn-success button-size" v-show="displayBtnImport" @click.prevent="btnImport" > Import </button>
        <button class="btn btn-sm btn-default button-size" @click.prevent="btnClose" > Close </button>
      </div>

      
        <div class="processing" align="left" v-if="processing">
          <img src="/assets/icons/loading_image.gif"/> Processing
        </div>
        <div v-else>
          <br><br>
        </div>
        <br>

        <!-- <pre>{{ $data  }}</pre> -->

    </div> 
  </div>


</template>


<script>

  var CONST_NEW='New';

  module.exports = {

    props: ['url','formTitle','inputFields'],

    mounted: function(){
      this.fields=this.jsonToArray(this.inputFields);
      //this.fields=arr;
      this.countFieldsRequired();
      this.fillSelectFields(); 
    },

    data: function() {
      return {
        currentItem:'',
        nuevo: 'disabled',
        IsCrudExpanded: false,
        expandOrCollapse: 'Expand',
        actionType: '',
        displayBtnSave:false,
        displayBtnUpdate:false,
        displayBtnDelete:false,
        displayBtnReset:false,
        displayBtnExport:false, 
        displayBtnImport:false,
        isDisableBtnSave:true,
        isDisableBtnUpdate:true,
        itemStatus: '',
        fields: [],
        fields2: [],
        fieldsRequired:[],
        processing: false
      }
    },

    methods: {

      validSelect: function(e, field){
        Vue.set(this, field.name, e.target.value);
        this.validFieldsRequired();
        for (key in this.fields) {
          if (this.fields[key].selectFather==field.name)  {
            this.loadSelectDependOfOtherSelect(this.fields[key]);
            Vue.set(this, this.fields[key].name, '1'); 
            break;
          }
        }

        var options = this.$get(field.table);
        for (key in options) {
           options[key].selected='';
        }
       Vue.set(this, field.table, options);

        this.getFieldValues();

      },

      getFieldName: function(name){
        return this.$get(name);
      },

      fillSelectFields:function(){
        for (var i = 0; i < this.fields.length; i++) {
          if (this.fields[i].type=="select")  {
            this.getOptionsForSelect(this.fields[i]);
            Vue.set(this, this.fields[i].name, '1');
            this.fields[i].value=1;
          }
        }
      },
      
      getOptionsForSelect: function(field){
         var id=(field.selectFatherId!==undefined) ? field.selectFatherId : '';
         var option = [];
         this.$http({url: field.url + '/' + id, method: 'GET'}).then(function(response){
            var info = {};
            for (var j = 0; j < response.data.length; j++) {
              info={};
              info.id = response.data[j].id;
              info.value = response.data[j][field.name];  
              info.selected='';
              option.push(info);
            } 
          }).catch(function (response) {
            this.displayPopUpMessage(response);
          }); 
          Vue.set(this, field.table, option);

      },

      countFieldsRequired: function(){
        for (var i = 0; i < this.fields.length; i++) {
          if (this.fields[i].required=="true") {
            this.fieldsRequired.push(i);
          }
        }
      },

      validFieldsRequired: function(){
        var valid=true;
        for (var i = 0; i < this.fieldsRequired.length-1; i++) {
          if (this.fieldsRequired[i]==i) {
           if (this.fields[i].value==''){
            valid=false;
           }
          }
        }
        this.isDisableBtnSave = !valid;
        this.isDisableBtnUpdate = !valid;
      },

      getFieldValues: function(){
        var fieldsValue='';
        for (var i = 0; i < this.fields.length; i++) {
          if (this.fields[i].type=="select"){
           fieldsValue+='"' + this.fields[i].name +  '" : "' + this.$get(this.fields[i].name) + '",'; 
         }
         else
            fieldsValue+='"' + this.fields[i].name +  '" : "' + this.fields[i].value + '",';
        }
        fieldsValue=  fieldsValue.substring(0, fieldsValue.length-1);
        this.currentItem=JSON.parse("{" + fieldsValue +"}");
      },

      getSelectID: function(field){
        var arr = this.$get(field.table);
        for (var i = 0; i < arr.length; i++) {
          if (arr[i].value==field.value)
            return arr[i].id;
          else
            return -1;
        }
      },

      btnReset: function(){
        this.isDisableBtnSave = true;
        this.isDisableBtnUpdate = true;
        for (i = 1; i < this.fields.length; i++) {
            this.fields[i].value='';
        }
       
       
      },

      btnSave: function(){
        this.getFieldValues();
        this.sendDataToDB(this.url, 'POST', this.currentItem);
        this.btnClose();
      },

      btnUpdate: function(){
      //  this.getFieldValues();
        this.sendDataToDB(this.url + '/' + this.currentItem.id, 'PUT', this.currentItem);
        this.btnClose();
      },

      btnDelete: function(){
        this.getFieldValues();
        this.sendDataToDB(this.url + '/' + this.currentItem.id, 'DELETE', this.currentItem);
        this.btnClose();
      },

      sendDataToDB: function(url, method, data){
        this.processing = true; 
        //this.$dispatch('progressBarStart');
        this.$http({url: url, method: method, data: data}).then(function(response){
          (method=='PUT') ? this.itemStatus="ok" : this.itemStatus="remove";
          this.reloadAfterAction();
          this.displayPopUpMessage(response);
          if (method=='POST'){
            this.initFieldsValues();
          }
        }).finally(function (response) {
           this.processing = false;
          // this.$dispatch('progressBarFinish');

        }).catch(function (response) {
          this.displayPopUpMessage(response);
           this.processing = false;
           //this.$dispatch('progressBarFinish');
        });    
      },

      btnClose: function(){
       eventHub.$emit('activateCrud', false);
      },

      btnExport: function(){
        this.btnClose();
      },

      btnImport: function(){
        this.btnClose();      
      },

      reloadAfterAction: function(){
       eventHub.$emit('reloadTable');
      },

      displayPopUpMessage: function(response){
        eventHub.$emit('displayAlert', (response.status==200) ? 'success' : 'danger', response.data.message + ' (' + response.status + ')');
      },

      expand: function(){
        this.IsCrudExpanded = !this.IsCrudExpanded;
        if (this.IsCrudExpanded){
          this.expandOrCollapse='Collapse'
        }else{
           this.expandOrCollapse='Expand'
        }
        eventHub.$emit('expandCrud');
      },

      jsonToArray: function(data){
        var parsed = JSON.parse(data);
        var arr = [];
        for(var x in parsed){
          arr.push(parsed[x]);
        }

        return arr;
      },

      initButtons: function(){
        this.displayBtnSave   =false;
        this.displayBtnUpdate =false;
        this.displayBtnDelete =false;
        this.displayBtnReset  =false;
        this.displayBtnExport =false;
        this.displayBtnImport  =false;
        //this.UpdateRecoverButton= 'Update';
      },

      initFieldsValues: function(){
        for (i = 0; i < this.fields.length; i++) {
          this.fields[i].value='';
        }
        this.fields[0].value=CONST_NEW;
      },

      loadSelectDependOfOtherSelect: function(field){
        var id=this.$get(field.selectFather);
        var option = [];
        this.$http({url: field.url + '/' + id, method: 'GET'}).then(function(response){
            var info = {};
            for (var j = 0; j < response.data.length; j++) {
              info={};
              info.id = response.data[j].id;
              info.value = response.data[j][field.name];  
              info.selected='';
              option.push(info);
            } 
          }).catch(function (response) {
            this.displayPopUpMessage(response);
          }).finally(function (response) {
            this.setValueInSelect(field);
            this.setFirstSelectValue(option, field);
            
          }); 
          Vue.set(this, field.table, option);
      },


      setFirstSelectValue: function(option, field){
          var id = option.filter(function(option){
            if (option.value==field.value) {
                return option.id
            }else{
              return 1
            }
          }).map(function(option){
              return option.id;
          });

          
          for (Itemfield in this.currentItem) { 
            if (Itemfield==field.name){
              this.currentItem[Itemfield]=id.pop();
              break;
            }
          }
          
          
      },

      setValueInSelect: function(field){
        var options= this.$get(field.table);
        //clear all selected attibute
        for (key in options) {
           options[key].selected='';
        }
        //set the selected item
        for (key in options) {
          if (options[key].value==field.value){
            options[key].selected='selected';
            this.$set(field.name, options[key].id);
            break;
          }
        }
        Vue.set(this, field.name, options[key].id);
      },

    },


    events:{

      add: function(){
        this.btnReset();
        this.initButtons();
        this.actionType      ='Add';
        this.displayBtnSave  = true;
        this.displayBtnReset = true;
        this.fields[0].value = CONST_NEW;
        this.fillSelectFields();
        this.validFieldsRequired();

      },
      
      edit: function(){
        this.initButtons();
        this.actionType       ='Edit';
        this.displayBtnUpdate = true;
        this.displayBtnDelete = true;
        this.displayBtnReset  = true;
        this.validFieldsRequired();
        this.isDisableBtnUpdate=false;
       // this.fillSelectFields();
      },
    
      displayRow: function(row){
        this.$emit('edit');
        var i=0;
        //Set the Values From the Table Row Selected
        for (var key in row){
          if (i<this.fields.length){
            this.fields[i].value=row[key];
            i++;

          }
        }
        //Set the Status Value in the Form Status Field
        this.itemStatus= (row.deleted_at==null) ? "ok" : "remove";
          //Set the Select Value in the Form Select Field 
        for (i = 0; i < this.fields.length; i++) {
          if (this.fields[i].type=="select"){
            if (this.fields[i].selectFather==undefined){
              this.setValueInSelect(this.fields[i]);
            } else{
              Vue.set(this, this.fields[i].name, '1');
              this.loadSelectDependOfOtherSelect(this.fields[i]);
            }
          }
        }  
        this.getFieldValues();
      },
    }
  }
</script>