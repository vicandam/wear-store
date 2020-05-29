
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
            
            <span>Order id: {{$id}}</span><br>
            <span>Dealer name:  {{ $order->dealer->user->name }}</span>
            
            <div class="table-responsive">
              <span>Ordered Items:</span>
              <table class="table-striped" >                
                <thead>
                  <tr>
                    <th>Item Name</th>
                    <th>Item Attributes</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Subtotal</th>                        
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>                
                  @foreach($order->order_details->sortByDesc('created_at') as $details)
                    <tr>                                                         
                      <td>{{ $details->item->name }}</td>
                      <td>                        
                        @foreach($details->item_attributes as $attribute)
                        <ul>
                          <li>{{ $attribute->attribute->name }} : {{ $attribute->attribute_value->attribute_value }}</li>
                        </ul>
                        @endforeach
                      </td>
                      <td>{{ $details->quantity }}</td>
                      <td>Php {{ $details->item->price }}</td>
                      <td>{{ $details->item->dealer_discount }} %</td>
                      <td>Php {{ ($details->item->price - (($details->item->dealer_discount/100 ) * $details->item->price)) * $details->quantity }}</td>
                      <td>{{ $details->status }}</td>
                      <td>{{ $details->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>            
          </div>
        </div>
        <hr>
        <div class="pull-right">
          <strong><p>Amount Due: Php {{number_format($total[$id], 2)}}</p>
          </strong>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>         
      </div>
    </div>
  </div>
</div>