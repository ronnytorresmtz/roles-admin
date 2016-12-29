<!DOCTYPE html>
<html>
  <head>

    <!--meta id="token" name="csrf-token" value="{!!csrf_token()!!}"-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
      
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
      {!! HTML::style('assets/css/bootstrap-theme.min.css') !!}
      {!! HTML::style('assets/pnotify/pnotify.custom.min.css') !!}
      <!--{!! HTML::style('assets/css/stylesheet.css') !!} -->
  </head>

  <body>




<div class="container-fluid" style="padding:8px">

    <div id="crud">

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#f5f5f5">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Importar Materias</h4>
            </div>
            <div class="modal-body">
              {{--!! Form::open(array('route'=>'academic.programs.import','files'=>true)) !!--}}

              <Form>
                
                {!! Form::label(Lang::get('labels.upload_file')) !!}
                <input type="file" name="fileToImport" id="fileToImport" @change.prevent="selectFile($event)">

                {{--!! Form::file('fileToImport') !!--}}
                <br>

                <div class="modal-footer">   
                 
                  {!! Form::submit(Lang::get('buttons.import'), array('class'=>"btn btn-sm btn-primary", '@click.prevent' => 'importItems($event)')) !!}
                  {!! Form::reset(Lang::get('buttons.clear'), array('class'=>"btn btn-sm btn-primary")) !!}
                  {!! Form::button('Close', array('class'=>"btn btn-sm btn-primary", 'data-dismiss' =>"modal" )) !!}
                   <div style="color:blue" v-if='loading' >
                    <br>
                    {!! HTML::image('assets/icons/loading_image.gif') !!} @{{fileProcessMsg}}
                  </div>
                 
                </div>
              
              </Form>
            </div>
           
          </div>
        </div>
      </div>


      <div  class="col-sm-2" align="left" style="padding:10px" v-show="show_menu">

              
            <div class="panel panel-default">
            
              <div id="transaction-panel-header" class="panel-heading" >
                <h3 class="panel-title">@{{title_menu}}</h3>
              </div>           

              <div class="panel-body">


              <table class= "table table-striped table-bordered table-condensed table-hover">
               
                <tbody v-for="option in menu_options">
                  <tr>
                    <td>@{{option}}</td>
                  </tr>
                </tbody>

              </table> 

              <input class="field" program_name="agree" type="checkbox" v-model="checked3"> Ver $Data

              <hr>
              <pre style ="background:graylight" v-show="checked3"> @{{$data.title_menu | json}}</pre>
              <pre style ="background:graylight" v-show="checked3"> @{{$data.menu_options | json}}</pre>
          </div>
        </div>
      </div>


      <div class="@{{colsize_table}}" align="left" style="padding:10px" v-show="show_table">

      <div class="panel panel-default">

          <div class="pull-right" style="padding:7px">
            <button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false" @click="expandTable($event)">
              <i id="icon-fullscreen" class="glyphicon glyphicon-fullscreen" ></i>
            </button>
          </div>
          
          <div id="transaction-panel-header" class="panel-heading" >
            <h3 class="panel-title">@{{title_data}}</h3>  
          </div>           

          <div class="panel-body">

        <div class="row">
          <div class="col-sm-8">
            <button id="btnViewItem" class="btn btn-sm btn-primary" @click="viewItem($event)"> 
            <i class="glyphicon glyphicon-file"></i> View  </button>
            <button id="btnAddItem" class="btn btn-sm btn-primary" @click="addItem($event)"> 
            <i class="glyphicon glyphicon-plus"></i> Add  </button>
            <button id="btnEditItem" class="btn btn-sm btn-primary" @click="editItem($event)"> 
            <i class="glyphicon glyphicon-pencil"></i> Edit  </button>
            <button id="btnDeleteItem" class="btn btn-sm btn-primary" @click="deleteItem($event)"> 
            <i class="glyphicon glyphicon-trash"></i> Delete  </button>
            {{--<button id="btnExport" class="btn btn-sm btn-primary" @click="exportItems($event)"> 
            <i class="glyphicon glyphicon-open"></i> Export  </button>--}}
            <a href="academic/programs/export" class="btn btn-sm btn-primary">   
              <i class="glyphicon glyphicon-open"></i>
              Export
            </a>
            <button id="btnImport "class="btn btn-sm btn-primary" @click="selectImportFile($event)"> 
            <i class="glyphicon glyphicon-save"></i> Import  </button>
          </div>


          <div class="col-sm-4">

            <div class="input-group">
                     
                {!!Form::text('search_value','',array(
                  'class' => 'form-control',
                  'size' => '10px', 
                  '@keyup:'=> 'display($event)',
                  'v-model' => 'searchText',
                  'autofocus' => 'autofocus'))!!}
                </input>
                  <span class="input-group-btn"  >
                    <button class="btn btn-primary" @click="searchItems($event)" > <i class="glyphicon glyphicon-search" style="padding:0px"></i>  </button>
                    </span>

                </div>
            
          </div>
        </div>
        <br>
        
        <div  class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:392px; padding:0px">
        
          <table  class= "table table-bordered table-condensed table-hover">
            <thead>
              <td>  </td>
              <td> ID </td>
              <td> Program ID </td>
              <td> Program Name </td>
              <td> Program Description </td>
              <td> Created At </td>
              <td> Update At </td>

            </thead>

            <!--tbody v-for="item in data | filterBy searchText"-->
            <tbody v-for="item in data">
             
              <tr>
                <td style="width:30px" align="center">

                <!--input id="@{{id}}" program_name="checked_items[]" type="checkbox" @click="rowSelected($event)"-->
                 <input id="@{{item.id}}" program_name="checked_item" class="checkbox" type="checkbox" @click="rowSelected($event)"/>
                 
                </td>
                <td style="min-width:50px"> @{{item.id}}</td>
                <td style="min-width:100px">@{{item.program_id}} </td>
                <td style="min-width:200px">@{{item.program_name}} </td>
                <td style="min-width:300px">@{{item.program_description}} </td>
                <td>@{{item.created_at}} </td>
                <td>@{{item.updated_at}} </td>
                
              </tr>
            
            </tbody>

          </table> 
        </div>


       <div class="row" padding="0px">
            <div class="col-sm-3 text-left">
              <div align="left">
                <br>
                <p style="font-size:13px;"> 
                {!!Lang::get('labels.showing')!!} @{{from}} {!!Lang::get('labels.to')!!} @{{to}} {!!Lang::get('labels.of')!!} 
                  @{{total}} {!!Lang::get('labels.items')!!} 
                </p>

              </div>
            </div>
          
            <div class="col-sm-9 text-right" style="padding-right:20px">
              <br>
              <button @click="goToFisrtPage" class=" btn btn-sm btn-primary" style="margin-right:5px"> First </button>
              <button @click="goToPrevious" class=" btn btn-sm btn-primary" style="margin-right:5px"> Prev </button>
              <button @click="goToNext" class=" btn btn-sm btn-primary" style="margin-right:5px"> Next </button>
              <button @click="goToLastPage" class=" btn btn-sm btn-primary" style="margin-right:5px"> Last </button>
            <div v-show="NoMorePages" style="color:gray"> <strong> <em>No more Pages</strong></em> </div>
            <div style="color:blue; padding-top:10px; padding-right:20px" v-if='loading'>{!! HTML::image('assets/icons/loading_image.gif') !!} Loading
            </div>
            </div>

       </div> 

        <br>
       <input class="field" program_name="agree" type="checkbox" v-model="checked"> Ver $Data
        <hr>

        <pre style ="background:graylight" v-show="checked"> @{{$data| json}}</pre>

        </div>
      </div>
    </div>

    

    <div class="@{{colsize_action}}" align="left" v-show="show_action" style="padding:10px">  

       <div class="panel panel-default">

           <div class="pull-right" style="padding:7px">
            <button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false" @click="expandAction($event)">
              <i id="icon-fullscreen" class="glyphicon glyphicon-list" ></i>
            </button>
          </div>
          
          <div id="transaction-panel-header" class="panel-heading">
            <h3 class="panel-title">@{{title_action}}</h3>
          </div>           

          <div class="panel-body">

          
        {!!Form::open() !!}
            
            {!!Form::label('ID')!!}

            {!!Form::text('id','',array(
              'class' => 'form-control',
              'size' => '10px', 
              '@keyup'=> 'display($event)',
              'v-model' => 'currentItem.id'))!!}

            <br>

            {!!Form::label('Program ID')!!}

            {!!Form::text('program_id','',array(
              'class' => 'form-control',
              'size' => '10px', 
              '@keyup'=> 'display($event)',
              'v-model' => 'currentItem.program_id'))!!}

            <br>

            {!!Form::label('Program Name')!!}

            {!!Form::text('program_name','',array(
              'class' => 'form-control',
              'size' => '10px', 
              '@keyup'=> 'display($event)',
              'v-model' => 'currentItem.program_name'))!!}

            <br>

             {!!Form::label('Program Description')!!}

            {!!Form::text('program_description','',array(
              'class' => 'form-control',
              'size' => '10px', 
              '@keyup'=> 'display($event)',
              'v-model' => 'currentItem.program_description'))!!}

            <br>

            <div v-show="btnShowReset">
              <input class="field" program_name="agree" type="checkbox" v-model="chkCloseAfterAction"> Close after action </input> <br> <br>
            </div>
           
            <button id="btnActionAdd" class="btn btn-sm btn-primary" v-show="btnShowAdd" @click.prevent="storeItem()"> 
            <i class="glyphicon glyphicon-plus"></i> Agregar</button>
            <button id="btnActionEdit" class="btn btn-sm btn-primary" v-show="btnShowEdit" @click.prevent="updateItem()"> 
            <i class="glyphicon glyphicon-pencil"></i> Actaulizar </button>
            <button id="btnActionDelete" class="btn btn-sm btn-primary" v-show="btnShowDelete" @click.prevent="destroyItem()"> 
            <i class="glyphicon glyphicon-trash"></i> Borrar </button>
            <button id="btnActionReset" class="btn btn-sm btn-primary" v-show="btnShowReset" @click.prevent="resetItem()">  
            <i class="glyphicon glyphicon-unchecked"></i> Reset </button>
            <button id="btnActionClose" class="btn btn-sm btn-danger" @click.prevent="closeAction()"> 
            <i class="glyphicon glyphicon-remove"></i> Close </button>
              
            
            <br> <br>

            <!--input class="field" program_name="agree" type="checkbox" v-model="checked2"> Ver $Data/-->

            <hr>

            <div style="color:blue;" v-if='Updating'>{!! HTML::image('assets/icons/loading_image.gif') !!} Updating
            </div>

            <!--pre style ="background:graylight" v-show="checked2"> @{{currentItem.id | json}}</pre> 

            <pre style ="background:graylight" v-show="checked2"> @{{currentItem.program_name | json}}</pre> 

            <pre style ="background:graylight" v-show="checked2"> @{{searchText | json}}</pre--> 

         {!!  Form::close() !!}

           </div> 
          </div> 
       </div> 
      </div> 

      

</div>    

    {!! HTML::script('assets/js/vue.js') !!}
    {!! HTML::script('assets/js/vue-resource.min.js') !!}
    {!! HTML::script('assets/js/jquery-1.11.1.min.js') !!}  
    {!! HTML::script('assets/js/bootstrap.min.js') !!}
    {!! HTML::script('assets/pnotify/pnotify.custom.min.js') !!}
    {!! HTML::script('assets/js/javascript.js') !!}


    <script type="text/javascript">

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
       // Vue.http.headers.common['X-CSRF-TOKEN']=$('#token').attr('value');
       // Vue.config.delimiters = ['@{{', '}}'];

        var crud =new Vue({

          el:'#crud',

          ready: function(){
            this.disableDOMElement({key1: 'btnViewItem', key2: 'btnEditItem', key3: 'btnDeleteItem'}, true);
            this.readPageData(this.url, false);
          },

          data: {

              menu_options: ['Level', 'Plan' , 'Programs', 'Subject' , 'Teachers', 'Students'],

              currentItem: {id:'', program_id:'', program_name:'', program_description:''},

              url:'academic/programs',

              searchText: '',

              checked: 0,
              checked2: 0,
              checked3: 0,
              chkCloseAfterAction: 0,
            
              show_action: false,
              show_action_is_on:false,
              show_menu: true,
              show_table: true,

              colsize_table: 'col-sm-10',
              colsize_action: 'col-sm-3',

              btnShowAdd: false,
              btnShowEdit: false,
              btnShowDelete: false,
              btnShowReset: false,
             
              title_action: 'Agregar Materia',        
              title_data: 'Materias',
              title_menu: 'Menu Options',

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
              Updating: false,
              fileProcessMsg:'',
              percentLoaded: 0,

              files: '',

              file:'',

              data: '',
          },

          methods:{
           
            goToFisrtPage: function(){
                this.goToNextPrev(this.first_page_url, this.first_page);
            },

            goToPrevious: function(){
                this.goToNextPrev(this.prev_page_url, this.first_page);
            },

            goToNext: function(){
                this.goToNextPrev(this.next_page_url, this.last_page);
            },

            goToLastPage: function(){
                this.goToNextPrev(this.last_page_url, this.last_page);
            },

            goToPageNumber: function($page){
              this.readPageData(this.url + '?page=' + $page, false);
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
              this.fileProcessMsg='loading page';
              this.NoMorePages=false;
              this.loading= true;
              this.$http.get(url, function (dataResponde, status, request){
                this.setDataResponde(dataResponde);
                this.routesFirstPrevNextLast(dataResponde);
                this.loading= false;
                this.fileProcessMsg='loading page end';
                $('#myModal').modal('hide');
                if (displayMsg){
                  this.displaySucceedMessage(status);
                }
              }).error(function (data, status, request) {
                this.loading= false;
                // handle error
                alert(status);
              });
            },

            setDataResponde: function (dataResponde){
                this.$set('data', dataResponde.data);
                this.$set('total', dataResponde.total);
                this.$set('per_page', dataResponde.per_page);
                this.$set('current_page', dataResponde.current_page);
                this.$set('last_page', dataResponde.last_page);
                if(dataResponde.to>0)
                  this.$set('from', dataResponde.from);
                else
                  this.$set('from', 0);
                this.$set('to', dataResponde.to);
            },

            routesFirstPrevNextLast: function(dataResponde){
               //get url without parameters
                if (dataResponde.next_page_url)
                    var page_url=dataResponde.next_page_url; 
                else
                    var page_url=dataResponde.prev_page_url; 

                //set the route for first, prev, next, last page action
                if (this.first_page!=this.current_page)
                  this.$set('first_page_url', page_url.slice(0, page_url.search('page')) + 'page=' + this.first_page + this.setSearchParam());

                this.$set('next_page_url', dataResponde.next_page_url + this.setSearchParam());
                this.$set('prev_page_url', dataResponde.prev_page_url + this.setSearchParam());
                
                if (this.last_page!=this.current_page)
                  this.$set('last_page_url', page_url.slice(0, page_url.search('page')) +  'page=' + this.last_page + this.setSearchParam());
            },

            setSearchParam: function(){
                var searchParam='';

                if (this.searchText)
                  searchParam= '&&searchText=' + this.searchText;

                return searchParam;
            },

            expandTable: function(e){
              if (this.show_menu){
                 this.displayOnlyTable();
              }else{
                this.show_menu=true;
                if (this.show_action_is_on){
                   this.displayMenuTableAndAction();
                }else{
                  this.displayMenuAndTable();
                }
              }
            },

            displayMenuAndTable: function(){
              this.colsize_table= 'col-sm-10';
            },

            displayMenuTableAndAction: function(){
              this.setShowAction(true);
              this.colsize_table= 'col-sm-7';
              this.colsize_action= 'col-sm-3';
            },

            displayOnlyTable: function(){
              this.show_menu=false;
              this.setShowAction(false);
              this.colsize_table= 'col-sm-12';
            },

            expandAction: function(e){
             this.show_table= ! this.show_table;

              if (this.show_table)
                this.displayActionSmallSize();
              else
                if (this.show_menu)
                  this.displayActionMediumSize();
                else
                  this.displayActionLargeSize();
            },

            displayActionSmallSize: function(){
              this.colsize_action= 'col-sm-3';
            },

            displayActionMediumSize: function(){
              this.colsize_action= 'col-sm-10';
            },

            displayActionLargeSize: function(){
              this.colsize_action= 'col-sm-12';
            },

            rowSelected: function(e){
              var $inputChecked = "input[program_name=checked_item]:checked";

              this.avoidMultipleSelection(e, $inputChecked);

              this.currentItem.id                  = $($inputChecked).parent().siblings("td:eq(0)").text().trim(); 
              this.currentItem.program_id          = $($inputChecked).parent().siblings("td:eq(1)").text().trim();
              this.currentItem.program_name        = $($inputChecked).parent().siblings("td:eq(2)").text().trim(); 
              this.currentItem.program_description = $($inputChecked).parent().siblings("td:eq(3)").text().trim(); 

               this.enableDisableActionsAddEdit();
            },

            avoidMultipleSelection: function(e, $inputChecked){
              var btnDisable=true;
              $($inputChecked).each(function() {
                var $row     = $(this).closest('tr');
                var $columns = $row.find('td');

                if ($columns[1].innerText !== e.target.id){
                  this.checked = false;                               
                }
                btnDisable=false;
               });

              this.disableDOMElement({key1: 'btnViewItem', key2: 'btnEditItem', key3: 'btnDeleteItem'}, btnDisable);

              if (btnDisable)
                this.addItem(e);
              else
                this.viewItem(e);
            },

            storeItem: function(e){
              this.Updating= true;
              this.$http.post(this.url, this.currentItem, function(data, status, request){
                this.reloadAfterAction();
                this.displaySucceedMessage(status);
              }
              ).error(function (data, status, request) {
                this.displayErrorMessage(status)
              });
            },

            updateItem: function(){  
               this.Updating= true;
              this.$http.put(this.url + '/' + this.currentItem.id, this.currentItem, function(data, status, request){
                this.reloadAfterAction();
                this.displaySucceedMessage(status);
              }
              ).error(function (data, status, request) {
                this.displayErrorMessage(status)
              });
            },

            destroyItem: function(){ 
              this.Updating= true;
              this.$http.delete(this.url + '/' + this.currentItem.id, this.currentItem, function(data, status, request){
                this.chkCloseAfterAction=true;
                this.reloadAfterAction();
                this.displaySucceedMessage(status);

              }
              ).error(function (data, status, request) {
                this.displayErrorMessage(status)
              });

            },

            selectImportFile: function(e){
              $('#myModal').modal('show');
            },

            selectFile: function(e){

              this.files = e.target.files;
            },

            importItems: function(e){
              //instance of FileReader
              var self=this;
              var reader = new FileReader();
              self.loading= true;
              //load file to memory. convert to json and execute an ajax call
              self.fileProcessMsg='importing file';
              reader.onload = function()  {
                var rows = reader.result.split('\r\n');
                var fields = rows[0].split(',');
                var data = self.convertoToJson(fields, rows);
                self.sendDataViaAjax(data);
              };
              reader.onerror = function(e) {
                  self.displayErrorMessage(evt.target.error.code);
              };
              //read the file  
              reader.readAsText(this.files[0]);
            },

            sendDataViaAjax:function(data){
              var self=this;
              $.ajax({
                method: "POST",
                dataType: "json",
                url: "academic/programs/import",
                data: {values: data}
              })
              .done(function( msg ) {
                self.readPageData(self.url, true);
                console.log('OKAjax');
              });
            },

            //convert rows/fields to json
            convertoToJson: function(fields, rows){
              var data='{';
              for (var i = 1; i < rows.length ; i++) {
                var rowData='"' + i + '":{';
                var row=rows[i].split(',')
                for (var j = 0; j < row.length ; j++) {
                  rowData=rowData + '"' + fields[j] + '":"' + row[j] + '",' ;
                }
                rowData= rowData.substr(0,rowData.length-1) + '}';
                data=data + rowData + ",";
              };
              data=data.substr(0,data.length-1) + '}';

              return data;
            },

            reloadAfterAction: function(){
                this.readPageData(this.url + '?page=' + this.current_page, false);
                this.Updating = false;
                if (this.chkCloseAfterAction){
                  this.hideShowAction();   
                }
            },

            displaySucceedMessage: function(status){
                this.Updating= false;
                MyApp.Mensaje('info', 'Success','Request was executed successfully' + ' (' + status + ')');
            },

            displayErrorMessage: function(status){
                 this.Updating= false;
                 MyApp.Mensaje('error', 'ERROR','Request was NOT executed successfully' + ' (' + status + ')');
            },

            hideShowAction: function(){
              this.setShowAction(false);
              this.colsize_table = 'col-sm-10'; 
            },

           
            viewItem: function(e){
              this.showAction('viewItem','Ver Materias');
            },

            addItem: function(e){
              this.resetItem();
              this.disableDOMElement({key1: 'btnViewItem', key2: 'btnEditItem', key3: 'btnDeleteItem'}, true);
              this.enableDisableActionsAddEdit();
              this.showAction('addItem','Agregar Materias');
            },

            editItem: function(e){
              this.showAction('editItem','Editar Materias');
            },

            deleteItem: function(e){
              this.showAction('deleteItem','Borrar Materias');
            },

            showAction: function(action, title){

              this.setShowAction(true);

              if (this.show_action)
                if (this.show_menu)
                  this.displayTableWithMenuAndAction();
                else
                  this.displayTableWithAction();
              else
                  this.displayTableWithMenu();

               this.title_action = title;
               this.enableButtons(action);
            },

            resetItem: function(){
              var $inputChecked = "input[program_name=checked_item]:checked";

              this.clearCurrentItem();
              $($inputChecked).each(function() {
                if (this.checked)  
                 this.checked = false;
              });
            },

            clearCurrentItem: function(){
              this.currentItem.id                  = '';
              this.currentItem.program_id          = '';
              this.currentItem.program_name        = '';
              this.currentItem.program_description = '';
            },


            displayTableWithMenuAndAction: function(){
            //this.colsize_action = 'col-sm-7';
              this.colsize_table = 'col-sm-7';
            },

            displayTableWithAction: function(){
              this.colsize_table = 'col-sm-9';
              this.colsize_action ='col-sm-3';
            },

            displayTableWithMenu: function(){
              this.colsize_action = 'col-sm-10';
            },

            enableButtons: function(action) {
              //viewItem
              this.btnShowAdd    = false;
              this.btnShowEdit   = false;
              this.btnShowDelete = false;
              this.btnShowReset  = false;
              $("input[name='id']").prop("disabled", true);
              $("input[name='program_id']").prop("disabled", true);
              $("input[name='program_name']").prop("disabled", true);
              $("input[name='program_description']").prop("disabled", true);

              switch(action) {
                  case 'addItem':
                    this.btnShowAdd= true;
                    this.btnShowReset= true;
                    $("input[name='id']").prop("disabled", true);
                    $("input[name='program_id']").prop("disabled", false);
                    $("input[name='program_name']").prop("disabled", false);
                    $("input[name='program_description']").prop("disabled", false);
                    this.resetItem();
                    break;
                  case 'editItem':
                    this.btnShowEdit= true;
                    this.btnShowReset= true;
                    $("input[name='id']").prop("disabled", true);
                    $("input[name='program_id']").prop("disabled", false);
                    $("input[name='program_name']").prop("disabled", false);
                    $("input[name='program_description']").prop("disabled", false);
                    break;
                  case 'deleteItem':
                    this.btnShowDelete= true; 
                    break;
              }
            },

            searchItems: function(e){
              this.readPageData(this.url + '/search?searchText=' + this.searchText, false);
            },

            closeAction: function (e){
              this.show_table=true;
              if (this.show_menu)
                this.displayMenuAndTable();
               else
                this.displayOnlyTable();

              this.displayActionSmallSize();

              this.setShowAction(false);
            },

            display: function(e){
              this.enableDisableActionsAddEdit();
            },

            setShowAction: function(status){
              this.show_action       = status;
              this.show_action_is_on = status;
            },

            enableDisableActionsAddEdit: function (){
              var btnDisable = true;
              if ((this.currentItem.program_description) && (this.currentItem.program_id) && (this.currentItem.program_name))
                  btnDisable = false;

              this.disableDOMElement({key1:'btnActionAdd', key2:'btnActionEdit'}, btnDisable);

              var btnDisable = true;
              if ((this.currentItem.program_description) || (this.currentItem.program_id)|| (this.currentItem.program_name))
                  btnDisable = false;
             
              this.disableDOMElement({key1:'btnActionReset'}, btnDisable);
            },

            disableDOMElement: function(DOMObjects, value){
              for (var element in DOMObjects){
                $("#" + DOMObjects[element]).prop('disabled', value);
              }
            }
          }
        });

    </script>

  </body></html>