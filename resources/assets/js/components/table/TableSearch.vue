<style scoped>

  .button-size{
    width: 50px;
  }

  .header {
    font-weight: bold;
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

  .selectwidth{
    width:80px;
  }

</style>

<template>

<div class="container-fluid">
  <div class="row">
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
          <div class="row">
            <div  v-if="!showTableOnly">
              <div class="col-sm-4">
                <div class="input-group" v-if="!showTableOnly">
                  <input type="text" v-model="searchText" class="form-control" @keyup.enter="search" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="button" @click="search">
                      <i class="glyphicon glyphicon-search"> </i>
                    </button>
                  </span>
                </div>
              </div>

              <div class="col-sm-6" align="left" @click="searchText=''">
                <div class="btn btn-xs btn-warning" v-show="filterApplied" style="margin:5px" >
                   Clear Filter <span> &times; </span>
                </div>
              </div>

            </div>
          </div>
          <br>
          
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
                           <!--  <i class="glyphicon glyphicon-ok"></i> -->
                        </span>
                        <span v-else>
                            <span class="btn btn-xs btn-danger"> Inactive </span>
                            <!-- <i class="glyphicon glyphicon-remove" ></i> -->
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
            <div class="row" v-show="!showTableOnly">
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

      <!-- <pre>{{ $data | json }}</pre>  -->

    </div>
</div>

</template>


<script>

 import MyLang from '../../components/languages/Languages.vue';
  
  module.exports = {

    mixins: [MyLang],

    props: ['tableId', 'tableTitle', 'columnsNames', 'url', 'iconInfo', 'iconActions', 'showTableOnly'],

    ready: function(){
      this.id=this.tableId;
      this.cols=this.jsonToArray(this.columnsNames);
      this.arrIconInfo=this.jsonToArray(this.iconInfo);
      this.arrIconActions=this.jsonToArray(this.iconActions);
      this.showTableOnly = (this.showTableOnly=='false') ? false : true;
      this.initialUrl = this.url;
      this.lastUrl =this.initialUrl;
      this.readPageData(this.lastUrl, false);
    },

    data: function() {
      return {
        id:'',
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
        arrIconInfo:[],
        arrIconActions:[],
        searchText: '',
        filterApplied: ''
      }
    },

    methods: {

      clickIcon: function(row, link){
        this.$route.router.go(link.url);
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
        this.$http.get(url).then(function (response){
          this.setDataResponse(response.data);
          this.routesFirstPrevNextLast(response.data);
          $('#' + this.id + ' td').remove(); 
        }).then(function (response) {
          this.loading= false;
        }).catch(function (response) {
          this.displayPopUpMessage(response);
          this.loading= false;
        });
      },

       setDataResponse: function (response){
        this.rows = response.data;
        this.total = response.total;
        this.per_page = response.per_page;
        this.current_page = response.current_page;
        this.last_page = response.last_page;
        if(response.to>0)
          this.from = response.from;
        else
          this.from = 0;
        this.to = response.to;
      },

      routesFirstPrevNextLast: function(response){
        //get url without parameters
        if (response.next_page_url){
          var page_url=response.next_page_url; 
        }
        else{
          var page_url=response.prev_page_url; 
        }
        //set the route for first, prev, next, last page action
        if (page_url){
          this.first_page_url=page_url.slice(0, page_url.search('page')) + 'page=' + this.first_page + this.setSearchParam();
          this.next_page_url=response.next_page_url + this.setSearchParam();
          this.prev_page_url=response.prev_page_url + this.setSearchParam();
          this.last_page_url=page_url.slice(0, page_url.search('page')) +  'page=' + this.last_page + this.setSearchParam();
         }
      },

      displayPopUpMessage: function(response){
        this.$dispatch('displayAlert', (response.status==200) ? 'success' : 'danger', response.data.message + ' (' + response.status + ')');
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
      }
    },

    watch: {
      'searchText': function(){
        if (! this.searchText){
          this.searchText='';
          this.search();
        }
      },
      
    }
    
  }
</script>