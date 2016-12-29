
// Dialog show event handler 

$(document).ready(function() {

  notification();

  $('#modalWindow').on('show.bs.modal', function (e) {

     // get data title sent as a parameter
     $title = $(e.relatedTarget).attr('data-title');
     // find the title section and set the title to be display
     $(this).find('.modal-title').text($title);
     // get data message sent as a parameter
     $message = $(e.relatedTarget).attr('data-message');
     // find the body section and set the message to be display
     $(this).find('.modal-body p').text($message);

      // Pass form reference to modal for submission on yes/ok
     var form = $(e.relatedTarget).closest('form');
     $(this).find('.modal-footer #confirm').data('form', form);
  });
    
  // Form confirm (yes/ok) handler, submits form 
  $('#modalWindow').find('.modal-footer #confirm').on('click', function(){
    console.log('User Press YES!!');
     $(this).data('form').submit();
  });


});

function notification() {
    console.log('entro a notification');
}
