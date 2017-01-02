<style scoped>

  .button-size{
    width: 50px;
  }

  .header {
    font-weight: bold;
  }

  tr{
    cursor: pointer;
  }

  .table-hscroll{
     white-space:nowrap;
     overflow-x:auto; 
     overflow-y:auto; 
     width:auto; 
  }

  .table-height{
    height:auto;
  }

  .select-margin{
    margin-bottom:10px;
  }

   .expand-botton{
    padding: 4px;
  }

  .filter-applied{
    position: absolute;
    margin-right: 10px;
    right: 0;
    top: 0;
    cursor: pointer;
    font-size: x-large;

  }

  .loadinggif 
  {
     background:
       url('/assets/icons/loading_image.gif')
       no-repeat
       left center;
  }

  .loading-spin 
  {
    margin: 0px; 
    padding: 0px; 
    position: fixed; 
    right: 0px; 
    top: 0px; 
    width: 100%; 
    height: 100%; 
    background-color: rgb(102, 102, 102); 
    z-index: 30001; 
    opacity: 0.6;
  }


</style>

<template>

<div class="container-fluid">
  <div class="row">
    <div class="row">
      <div :class="colWidthTable" v-show="IsCrudExpanded">
        <div class="panel panel-default" > 
          <div class="panel-heading">
            <h3 class="panel-title">
              {{tableTitle}}
              <span style="color:blue; padding-top:10px; padding-right:20px" align="left" v-if='loading'>
                <img src="/assets/icons/loading_image.gif"/>   
              </span>
            </h3>
          </div> 
          <div class="panel-body">
            <div class="row" >
              <div class="col-sm-4">
                <div v-show="(selects.length>0) ? true : false">
                  <div class="select-margin" v-for="select in selects">
                      <b>{{select.label}}:</b> 
                      <select 
                        class="form-control"
                        name="select.name" 
                        required={{select.required}}  
                        :disabled="select.readonly"
                        @change="accessRightForRoleSelected($event)">
                        <option 
                          v-for="op in getFieldName(select.table)"
                          :selected="op.selected" 
                          value={{op.id}} 
                          label={{op.value}}>
                        </option>
                      </select>
                  </div>
                </div>
                <div v-else> 
                  <div class="input-group" v-show="showTableOnly">
                    <input type="text" v-model="searchText" class="form-control" @keyup.enter="search" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="button" @click="search">
                        <i class="glyphicon glyphicon-search"> </i>
                      </button>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-sm-3" align="left" @click="searchText=''">
                <div class="btn btn-xs btn-warning" v-show="filterApplied" style="margin:5px" >
                   Clear Filter <span> &times; </span>
                </div>
              </div>

              <div class="col-sm-5" align="right">
                  <slot name="crud"></slot>
              </div>
            </div>
            
            <div  class="table-responsive table-hscroll table-height">
              <table id="{{id}}" class= "table table-striped table-bordered table-condensed table-hover" >
                <col v-for="col in cols" :width="col.width">
                <!--/div-->
                <thead>
                  <tr>
                    <th class="header" v-for="col in cols"> 
                         {{ ts[col.name] }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="1 in 10">
                    <td v-for="1 in cols.length"> &nbsp; </td>
                  </tr> 
                    
                  <tr v-for="row in rows"> 
                    <td  v-for="(key, value) in row" @click="itemSelected(row)">
                      <span v-if="key=='deleted_at'" >
                          <span v-if="value==undefined">
                              <span class="btn btn-xs btn-success"> Active </span>
                          </span>
                          <span v-else>
                              <span class="btn btn-xs btn-danger"> Inactive </span>
                          </span>
                      </span>

                      <span v-else>
                          {{value}} 
                      </span>

                    </td>
                
                    <td v-if="(arrIconInfo.length > 0)">
                      <span v-for="info in arrIconInfo">
                        <a href="{{info.url}}" title="{{info.title}}" @click.prevent="clickIcon(row, info)"> <i class="{{info.icon}}"></i> {{info.text}} </a>
                      </span>
                    </td>

                    <td v-if="(arrIconActions.length > 0)">
                      <span v-for="action in arrIconActions">
                        <a href="{{action.url}}" title="{{action.title}}" @click.prevent="clickIcon(row, action)"> <i class="{{action.icon}}"></i> {{action.text}} </a>
                      </span>
                    </td>

                  </tr> 
                 </tbody> 
              </table> 
            </div>
            <div > 

            </div>
              <div class="row">
                 <div class="col-sm-6">
                  <div align="left" style="padding-top:10px">
                  <p style="font-size:13px;" > 
                     Showing: {{from}} to {{to}} of {{total}} items
                  </p>
                  </div>
                </div>
                <div v-if="NoMorePages" style="color:gray" align="right"> 
                  <strong> <em>No more Pages</strong></em> 
                </div>  
                <div class="col-sm-6">
                  <div align="right" style="padding-top:10px">
                    <a class="btn btn-sm btn-primary button-size" @click.prevent="goToFisrtPage"> Start </a> 
                    <a class="btn btn-sm btn-primary button-size" @click.prevent="goToPrevPage"> Prev </a> 
                    <a class="btn btn-sm btn-primary button-size" @click.prevent="goToNextPage"> Next </a> 
                    <a class="btn btn-sm btn-primary button-size" @click.prevent="goToLastPage"> End </a> 
                    <br/> <br/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end form  component-->
        <div :class="colWidthCrud" v-show="IsCrudDisplayed">
            <slot name="forma"></slot>
        </div>
      </div>
      <!-- <pre>{{ $data | json }}</pre>  -->
    </div>
  </div>
</div>;

</template>


<script>

 import MyLang from '../../components/languages/Languages.vue';

  var tableExpanded  ='col-sm-12';
  var tableCollapsed ='col-sm-8';
  var crudExpanded   ='col-sm-12';
  var crudCollapsed  ='col-sm-4';
  
  module.exports = {

    mixins: [MyLang],

    props: ['tableId', 'tableTitle', 'selectFields', 'columnsNames', 'url', 'iconInfo', 'iconActions'],

    ready: function(){
      this.id=this.tableId;
      this.cols=this.jsonToArray(this.columnsNames);
      this.selects=this.jsonToArray(this.selectFields);
      this.arrIconInfo=this.jsonToArray(this.iconInfo);
      this.arrIconActions=this.jsonToArray(this.iconActions);
      this.showTableOnly=(this.showTableOnly=='false') ? false : true;
      this.fillSelectFields();   
      this.initialUrl = this.url;
      this.lastUrl =this.initialUrl;
      this.readPageData(this.lastUrl, false);
    },

    data: function() {
      return {
        id:'',
        colWidthTable: tableExpanded,
        colWidthCrud: crudCollapsed,
        IsCrudDisplayed: false,
        IsCrudExpanded: true,
        initialUrl: '',
        lastUrl: '',
        current_page:'',
        per_page:'',
        first_page: 1,
        last_page:'',
        to:'',
        from:'',
        first_page_url:'',
        next_page_url:'',
        prev_page_url:'',
        last_page_url:'',
        total:'',
        NoMorePages:false,
        loading: false,
        cols: [],
        rows:[],
        selects: [],
        arrIconInfo:[],
        arrIconActions:[],
        searchText: '',
        filterApplied: '',
        showTableOnly:false
      }
    },

    methods: {

      clickIcon: function(row, link){
        this.$route.router.go(link.url);
      },

      itemSelected: function(row){
        this.$dispatch('rowSelected', row);
      },

      goToFisrtPage: function(){
        this.goToNextPrev(this.first_page_url, this.first_page);
      },

      goToPrevPage: function(){
        this.goToNextPrev(this.prev_page_url, this.first_page);
      },

      goToNextPage: function(){
        this.goToNextPrev(this.next_page_url, this.last_page);
      },

      goToLastPage: function(){
        this.goToNextPrev(this.last_page_url, this.last_page);
      },

      goToPageNumber: function($page){
        this.readPageData(this.lastUrl + '?page=' + $page, false);
        this.NoMorePages=false;
      },

      goToNextPrev: function(goToUrl , pageNumber){

        if (pageNumber!=this.current_page){
          if (goToUrl!=="null") {
            this.readPageData(goToUrl, false);
            this.NoMorePages=false;
          }else
            this.NoMorePages=true;
        }else{
          this.NoMorePages=true;
        }
      },

      readPageData: function(url, displayMsg){
        this.NoMorePages=false;
        this.loading= true;
        this.$http.get(url).then(function (responde){
          this.setDataResponde(responde.data);
          this.routesFirstPrevNextLast(responde.data);
          $("#" + this.id + " td").remove(); 
        }).then(function (responde) {
          this.loading= false;
        }).catch(function (responde) {
          alert(responde.status);
          this.loading= false;
        });
      },

       setDataResponde: function (responde){
        this.rows = responde.data;
        this.total = responde.total;
        this.per_page = responde.per_page;
        this.current_page = responde.current_page;
        this.last_page = responde.last_page;
        if(responde.to>0)
          this.from = responde.from;
        else
          this.from = 0;
        this.to = responde.to;
      },

      routesFirstPrevNextLast: function(responde){
        //get url without parameters
        if (responde.next_page_url){
          var page_url=responde.next_page_url; 
        }
        else{
          var page_url=responde.prev_page_url; 
        }
        //set the route for first, prev, next, last page action
        if (page_url){
          this.first_page_url=page_url.slice(0, page_url.search('page')) + 'page=' + this.first_page + this.setSearchParam();

          this.next_page_url=responde.next_page_url + this.setSearchParam();
          this.prev_page_url=responde.prev_page_url + this.setSearchParam();
          
          this.last_page_url=page_url.slice(0, page_url.search('page')) +  'page=' + this.last_page + this.setSearchParam();
         }
      },

      setSearchParam: function(){
        var searchParam='';

        if (this.searchText)
          searchParam= '&&searchText=' + this.searchText;

        return searchParam;
      },

     
      search: function(){
        this.filterApplied=this.searchText;
        this.readPageData(this.lastUrl + '/search?searchText=' + this.searchText, false);
      },


      jsonToArray: function(data){
        var parsed = JSON.parse(data);
        var arr = [];
        for(var x in parsed){
          arr.push(parsed[x]);
        }

        return arr;
      },

      getFieldName: function(name){
        return this.$get(name);
      },

      fillSelectFields:function(){
        for (var i = 0; i < this.selects.length; i++) {
            this.getOptionsForSelect(this.selects[i]);
            this.$set(this.selects[i].name,'1');
        }
      },
      
      getOptionsForSelect: function(select){
         var option = [];
         this.loading= true;
         this.$http({url: select.url, method: 'GET'}).then(function(response){
            var info = {};
            for (var j = 0; j < response.data.data.length; j++) {
              info={};
              info.id = response.data.data[j].id;
              info.value = response.data.data[j][select.name];  
              info.selected='';
              option.push(info);
            } 
          }).then(function (responde) {
             this.loading= false;
          }).catch(function (responde) {
            this.displayPopUpMessage(response);
            this.loading= false;
          });
          
          this.$set(select.table, option);
      },

      displayPopUpMessage: function(response){
        this.$dispatch('displayAlert', (response.status==200) ? 'success' : 'danger', response.data.message + ' (' + response.status + ')');
      },

      accessRightForRoleSelected: function(e){
       this.IsCrudDisplayed=false;
       this.lastUrl=this.initialUrl;
       this.readPageData(this.initialUrl + '/roleSelected/' + e.target.value , false);
       this.lastUrl = this.lastUrl + '/roleSelected/' + e.target.value ;
      },

    },

    events: {

      displayCrud: function(val) {
        this.IsCrudDisplayed = val;
      },

      expandCrud: function(){
        this.IsCrudExpanded= !this.IsCrudExpanded;
      },

      reloadData: function(){
        this.readPageData(this.lastUrl + '?page=' + this.current_page, false);
      },

    },

    watch: {

      'searchText': function(){
        if (! this.searchText){
          this.searchText='';
          this.search();
        }
      },

      'IsCrudDisplayed': function (val, valold){
        if (this.IsCrudDisplayed){
          this.colWidthTable = tableCollapsed;
        }else{
          this.IsCrudExpanded = true;
          this.colWidthTable = tableExpanded;
        }
      },

      'IsCrudExpanded': function (val, valold){
        if (this.IsCrudExpanded){
          this.colWidthCrud = crudCollapsed;
        }else{
          this.colWidthCrud = crudExpanded;
        }
      }

    }
    
  }
</script>