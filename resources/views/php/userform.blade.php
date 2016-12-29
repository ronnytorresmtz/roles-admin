<!--script to display a modal confirmation window -->

<div class="modal fade" id="userform" tabindex="-1" role="dialog" aria-labelledby="modalWindowLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">{!!Lang::get('labels.user_info')!!}</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'security.users.store')) !!}


      <!--div class="conteiner"-->

            <div class="control-group">

              {!!Form::label(Lang::get('fields.person_id'))!!}        
              {!!Form::text('person_id','', array('class' => 'form-control','size' => '10px'))!!}
            </div>  

            <div class="control-group">

            {!!Form::label(Lang::get('fields.username'))!!}
            {!!Form::text('username','',array('class' => 'form-control',
            'size' => '10px'))!!}
              
            </div>
          
        
          
            <div class="control-group">
              {!!Form::label(Lang::get('fields.user_fullname'))!!}        
              {!!Form::text('user_fullname','', array('class' => 'form-control','size' => '10px'))!!}
            </div>  
          

            <div class="control-group">

              {!!Form::label(Lang::get('fields.email'))!!}
              {!!Form::email('email','',array('class' => 'form-control','size' => '10px'))!!}

            </div>

            <hr>

            <div class="control-group ">
              {!!Form::submit(Lang::get('buttons.add'),array ('class'=>'btn btn-sm btn-primary'))!!}
              {!!Form::reset(Lang::get('buttons.clear') ,array ('class'=>'btn btn-sm btn-primary'))!!}
            
              {!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
            </div>
      
      {!!  Form::close() !!}
      </div>
      
    </div>
  </div>
</div>