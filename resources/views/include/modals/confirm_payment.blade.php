

  <div id="confirm_payment-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-dialog-override">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Confirm payment</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="modal-content">          
            <div class="confirm_style" style="margin-left: 18px">              
              <div class="row">
                <div class="col-md-6">
                  <span>Order id: {{$id}}</span><br>
                  <span>Dealer name:  {{ $order->dealer->user->name }}</span><br>
                  <span>Pay by: {{ Auth()->user()->name }}</span>
                </div>
                <div class="col-md-6">
                  <span>
                    Amount Due: Php {{number_format($total[$id], 2)}}
                  </span>
                  <br>
                  <span class="modal_paid_{{$id}}">Paid: Php
                      {{
                          @$order->payment_details[0]->total != null ? number_format(@$order->payment_details[0]->where('order_id', $order->id)->sum('total'), 2) : '0.00'

                      }}                    
                  </span>
                  <br>
                  <span class="modal_balance_{{$id}}">                   
                      Balanced: Php 
                      {{
                        @$order->payment_details[0]->total != null ? number_format( $total[$order->id] - (@$order->payment_details[0]->where('order_id', $order->id)->sum('total')), 2) : '0.00'
                      }}                    
                  </span>                 
                </div>
              </div>             
              <br>
              <div class="table-responsive">
                <span>Ordered Items:</span>
                <table class="table-striped" >                
                  <thead>
                    <tr>
                      <th>Item Name</th>
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

          <div class="amount-pay">              
            <input type="number" name="total" id="total_{{$id}}" placeholder="Enter amount to pay..." class="form-control">
            <input type="hidden" name="order_id">
            <input type="hidden" name="dealer_id" value="{{$dealer}}">
          </div>          
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
          <button type="submit" id="{{$id}}" class="btn btn-primary proceed">Proceed</button>
        </div>
      </div>
    </div>
  </div>