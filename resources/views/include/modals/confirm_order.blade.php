<div id="confirm_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
     class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">Confirm order</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="modal-content" style="padding-top: 25px">
                    <input type="hidden" name="item" id="item">
                    <input type="hidden" name="price" id="price">
                    <input type="hidden" name="dealer_id" id="dealer_id">
                    <input type="hidden" name="item_id" id="item_id">
                    <input type="hidden" name="qty" id="qty">
                    <span>
              {!! 
                
                '<strong>Item name: </strong>'.$item .'<br>' 
                .'<strong>Price: </strong>'.$price .'<br>' 
                .'<strong><p class="qty"></p></strong>'.'<br>'
                .'<strong><p class="price"></p></strong>'

              !!}
              <strong><p class="price_total"></p></strong>
              </span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                <button @click="saveOrder" class="btn btn-primary proceed">Proceed</button>
            </div>
        </div>
    </div>
</div>
