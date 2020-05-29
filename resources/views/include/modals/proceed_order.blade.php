

  <div id="confirm_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Order Details</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>        
        <div class="modal-body">          
            <div class="form-group">              
              <strong>Name: </strong><label v-text="dealer_name"></label><br>
              <strong>Credit Limit: </strong>Php <label v-text="credit_limit"></label>                         
            </div>          

            <br>
            <div class="form-group">            
                <strong>Payable: </strong>Php <label id="payable"></label><br>
                <strong>Balance: </strong>Php <label v-text="credit_balance"></label>
            </div>          
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
          <button type="submit" @click="completeOrder(orders.id)" name="receipt" :value="orders.id" id="submit_order" class="btn btn-primary">
            Proceed
          </button>
        </div>
      </div>
    </div>
  </div>