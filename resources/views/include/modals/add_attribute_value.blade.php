

  <div id="add_attribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Add Attribute Value</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>        
        <div class="modal-body">          
            <label>Enter Attribute Value </label>
            <input class="form-control" id="attr_value" type="text" name="value">            
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
          <button type="button" @click.prevent="addAttributeValue" id="save" class="btn btn-primary">
            Proceed
          </button>
        </div>
      </div>
    </div>
  </div>