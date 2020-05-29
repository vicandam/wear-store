

  <div id="order_details_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-dialog-override">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Order Details</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">          
          <div class="modal-content">            
            <div style="margin-left: 18px">              
            
            <span>Order id: {{ $id }}</span><br>            
            <span>Dealer name:  {{ $order->dealer->user->name }}</span><br>
            <span>Paid by: {{ $order->user->name }}</span>

            <div class="table-responsive">
              <span>Ordered Items:</span>
                  <table class="table-striped">                    
                    <thead>
                      <tr>                        
                        <th>id</th>
                        <th>Item Name</th>
                        <th>Item attributes</th>
                        <th>Quantity</th>
                        <th>Price</th>                        
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($order->order_details as $item)                                      
                        <tr>                              
                            <td>{{ $item->item_id }} </td>                              
                            <td>{{ $item->item->name }} </td>
                            <td>
                              @foreach($item->item_attributes as $attribute)
                              <ul>
                                <li>{{ $attribute->attribute->name }} : {{ $attribute->attribute_value->attribute_value }}</li>
                              </ul>
                              @endforeach
                            </td>                             
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->item->price }}</td>
                            <td>{{ $item->item->price * $item->quantity }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at }}</td>
                         </tr>
                      @endforeach                    
                    </tbody>
                  </table>
              </div>          
            </div>
          </div>

          <hr>

          <div class="pull-right"><strong><p>Total Amount Ordered: Php {{ number_format($total[$id], 2) }}</p></strong></div>
          <p v-text="e_id"></p> 
                    
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>         
        </div>
      </div>
    </div>
  </div>