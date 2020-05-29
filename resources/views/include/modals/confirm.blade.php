

  <div id="confirm_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Confirm to delete record</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          
          <p>Are you sure you want to delete {!! $data !!}? <br>This action is irrevocable.</p>
          
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </div>
    </div>
  </div>