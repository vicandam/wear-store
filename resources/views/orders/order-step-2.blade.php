
@extends('layouts.app')

@section('content')
<!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Forms</li>
          </ul>
        </div>
      </div>

      <div class="contailer">
        @include('include.partials.success')
      </div>      

      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
              <h1 class="h3 display">Items</h1> 
              <form method="GET">
                  <div class="row">
                      <div class="col-md-6"> 
                           <div class="form-group">
                            <select name="category" class="form-control">
                              @foreach($cetagories as $category)
                                <option value="$category->id">{{ $category->name }}</option>
                              @endforeach
                            </select>  
                          </div>
                      </div>      
                      
                      <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" name="search" placeholder="Search" class="pull-right form-control"> 
                          </div> 
                      </div>   
                  </div>
                  
                  <div class="row" style="margin-top:10px" >
                       <div class="col-md-6">  
                           <div class="form-group"  >
                                <button type="submit" class="btn btn-success" > Search </button>
                           </div>
                      </div>  
                  </div>                    
                  
              </form>
          </header> 
          
          <div class="row">  
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Items</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="orders" class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Category</th> 
                          <th>Price</th>
                          <th>Available</th>
                          <th>Quantity</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>  
                        
                      @foreach($items as $item)
                        <tr>
                          <th scope="row">{{ $item->id }}</th>
                          <td>                             
                             <img src="/storage/avatars/{{ $item->photo }}" alt="category" class="" style="width: 50px">
                          </td>
                          <td>
                              <p>
                                {{ $item->name }}
                              </p>
                            </td>
                            <td> 
                                <span>
                                   {{ $item->category->name }}
                               </span>
                            </td>  <td> 
                                <span>
                                   {{ $item->price }}
                               </span>
                            </td>  
                          <td> 
                              <p>
                                  {{ $item->quantity }}
                              </p>
                          </td>  
                          <td> 
                              <input type="number" name="quantity" class="form-control qty_{{$item->id}}" value="1">  
                          </td>
                          <td>  
                              
                              <button type="button" id="qty_{{$item->id}}" class="btn btn-success" data-toggle="modal" data-target="#confirm_{{$item->id}}"> Add </button>
                        
                              {{ Form::model($items, array('route' => array('process_order', $item->id), 'method' => 'post')) }}
                                                        
                                @include('include.modals.confirm_order', ['id' => $item->id, 'item' => $item->name, 'price' => $item->price, 'quantity' => $item->quantity])

                              {{ Form::close() }}                                
                              
                          </td>
                        </tr>
                      @endforeach
                        
                      </tbody>
                    </table>
                  </div>

                  {{ $items->links() }}
                    
                </div>
              </div>
            </div> 
          </div>                                             

         <div class="row">
             <div class="col-lg-12" >
                   <header> 
                      <h1 class="h3 display">Order Details</h1> 
                      <div>
                          <span>
                            <b>Name</b>: Jesus Erwin Suarez  
                          </span>
                          
                          <br>
                          
                          <span>
                            <b>Credit Limit</b>: Php 2,000
                          </span>
                          
                          <br> <br>
                          
                          <span>
                            <b>Payable</b>: Php 1,000.00
                          </span>
                          <br>
                          <span>
                            <b>Balance</b>: Php 1,000.00
                          </span>
                          
                          
                      </div> 
                  </header> 
             </div>
              
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Cart</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Price</th> 
                          <th>Quantity</th>
                          <th>Subtatotal</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>  
                        <tr>
                          <th scope="row">1</th>
                          <td> 
                             <img src="img/avatar-7.jpg" alt="person" class="" style="width: 50px"  > 
                          </td> 
                            <td>
                              <b>
                                   Natashia
                              </b>
                            </td> 
                            <td>
                                <p>
                                    This is the dummy information of this items.                               
                                    This is the dummy information of this items. 
                                </p>
                            </td>  
                            <td>  
                                <span>
                                    Php 2,000.00   
                                </span>
                            </td>   
                            <td> 
                               2 
                          </td>
                            <td> 
                               php 4,000 
                          </td>
                          <td>  
                              <button type="submit" class="btn btn-danger" > Remove </button> 
                          </td>
                        </tr> 
                          
                         
                          <!-- Total -->
                         <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                               
                                <td>
                                    <b>Total</b> 
                                    <br> 
                                    <span></span>4,000
                             
                             </td>
                                <td>  </td>
                          </tr>
                      </tbody>
                    </table>  
                    <hr>  
                  </div> 
                    <div class="form-group" style="margin-top:10px">
                        <a href="order-step-3.html">
                            <button type="submit" class="btn btn-info" > Proceed </button>     
                        </a>        
                    </div>  
                </div>
              </div>
            </div> 
          </div> 
        </div>
      </section>
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Your company &copy; 2017-2019</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>

@endsection
@section('more_script')
  <script type="text/javascript">
    $(document).ready(function() {

      $('.btn-success').click(function() {
          var id = $(this).attr('id');

          var quantity = $('.'+id).val();
          $('.qty').text('Quantity: '+quantity);
          $('input[name=qty]').val(quantity);

          $('.alert-success').fadeIn().delay(5000).fadeOut();
      });

      // $('#proceed').click(function(e) {

      //     alert('hello');

      //     e.preventDefault();

      //     var item = $('input[name=item]').val();
      //     var price = $('input[name=price]').val();
      //     var dealer_id = $('input[name=dealer_id]').val();
      //     var qty = $('input[name=qty]').val();
      //     var url = "{{ url('order-step-2/'.$item->id) }}";
      //     var csrf_token = $('meta[name="csrf-token"]').attr('content');

      //     $.ajax({

      //       type: 'post',
      //       url: url,
      //       data: {item:item,price:price,dealer_id:dealer_id,qty:qty,"_token":csrf_token},
      //       dataType: 'json',
      //       success:function(data){
      //         alert(data);
      //       },
      //       error: function(error) {
      //         console.log(error);
      //       }

      //     });          

      //   });

      // function onSubmit() {

        
          
      // }

    });
  </script>
@endsection