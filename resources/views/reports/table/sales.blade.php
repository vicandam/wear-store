<table class="table">
	<thead>
		<tr>
			<th class="dealer_name">Dealer Name</th>
            <th class="dealer_group">Dealer Group / Recruiter</th>
            <th class="category">Category</th> 
            <th class="item_name">Item Name</th> 
            <th class="tra">TRA #</th> 
            <th class="gross_selling">Gross Selling Price</th>
            <th class="dealer_discount">Dealer Discount</th>
            <th class="store_profit">Store Profit</th>
            <th class="net_amount">Net Amount</th>
            <th class="cash_payment">Cash Payment</th>
            <th class="date_created">Date</th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $detail)
          <tr>
            <th scope="row" class="dealer_name">{{ $detail->order->dealer->user->name }}</th>
            <td class="dealer_group">
              {{ $detail->order->dealer->recruiter }}
            </td>
            <td class="category"> 
              {{ $detail->item->category->name }}
            </td>
            <td class="item_name"> 
              {{ $detail->item->name }}
            </td>  
            <td class="tra">
                {{ $detail->created_at->year .'-'. str_pad($detail->order_id, 4, '0', STR_PAD_LEFT) }}
            </td>  
            <td class="gross_selling"> 
              {{ $detail->item->price }}
            </td>    

            <td class="dealer_discount">
              {{ $detail->item->dealer_discount }} %
            </td> 
            <td class="store_profit">
              {{ $detail->item->store_profit }}
            </td>  

            <td class="net_amount">  
              {{ $detail->item->net_amount }}
            </td>

            <td class="cash_payment">  
              Php {{ number_format(($detail->item->price - (($detail->item->dealer_discount/100 ) * $detail->item->price)) * $detail->quantity, 2) }}              
            </td>
            <td class="date_created">  
              {{ $detail->created_at }}
            </td>                    
          </tr>
          @endforeach

	</tbody>
</table>
