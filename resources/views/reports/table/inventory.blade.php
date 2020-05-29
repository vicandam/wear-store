<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Photo</th>
      <th class="name">Name</th>
      <th>Price</th>
      <th class="available">Available</th>
      <th class="category">Category</th>                          
      <th class="dealer_discount">Dealer Discount</th>
      <th class="store_profit">Store Profit</th>
      <th class="net_amount">Net Amount</th>
    </tr>
  </thead>
  <tbody>  
    @foreach($items as $item)
    <tr>
      <th scope="row">{{$item->id}}</th>
      <td> 
       <img src="/storage/avatars/{{ $item->photo }}" alt="item" class="" style="width: 50px" >
     </td>
     <td class="name">
      <p>
        {{ $item->name }}
      </p>
    </td>
    <td>
      <p>
       {{ $item->price }}
     </p>
   </td>
   <td class="available">
    <p>
      {{ $item->quantity }}
    </p>
  </td>
  <td class="category">{{$item->category->name}}</td>
  <td class="dealer_discount">{{$item->dealer_discount}}</td>
  <td class="store_profit">{{$item->store_profit}}</td>
  <td class="net_amount">{{$item->net_amount}}</td>                            
  
</tr>
@endforeach
</tbody>
</table>