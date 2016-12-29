<!--script to display a modal confirmation window -->

<div class="modal fade" id="modalWindow" tabindex="-1" role="dialog" aria-labelledby="modalWindowLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Title</h4>
      </div>
      <div class="modal-body">
        <p>Message</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="confirm">{!!Lang::get('buttons.yes')!!}</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">{!!Lang::get('buttons.no')!!}</button>
      </div>
    </div>
  </div>
</div>