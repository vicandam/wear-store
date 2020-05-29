@extends('layouts.app')
@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Tables       </li>
    </ul>
  </div>
</div>
<section>
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="h3 display">Report range</h1> 
      <form method="GET">
        <div class="row">
          <div class="col-md-6"> 
           <div class="form-group">
            <select name="range" id="range" class="form-control">
              <option disabled selected>Select Range</option>
              <option value="daily" {{ request('range') == 'daily' ? 'selected' : '' }}>Daily</option>
              <option value="weekly" {{ request('range') == 'weekly' ? 'selected' : '' }}>Weekly</option>
              <option value="monthly" {{ request('range') == 'monthly' ? 'selected' : '' }}>Monthly</option>
            </select>  
          </div>

          <div class="form-group day" {!! request('range') != 'daily' ? 'style="display: none;"' : '' !!} > 
          <label> Day</label>
          <input type="date" name="day" value="{{request('range') == 'daily' ? request('day') : ''}}" class="form-control"> <br>                                  
        </div>

        <div class="form-group week" {!! request('range') != 'weekly' ? 'style="display: none;"' : '' !!} > 
        <label> Week</label>
        <input type="week" name="week" value="{{request('range') == 'weekly' ? request('week') : ''}}" class="form-control" > <br>                                 
      </div>

      <div class="form-group month" {!! request('range') != 'monthly' ? 'style="display: none;"' : '' !!} > 
      <label> Month</label>
      <input type="month" name="month" value="{{request('range') == 'monthly' ? request('month') : ''}}" class="form-control" > <br>                             
    </div>    

  </div> 
  <div class="col-md-6">
    <div class="form-group">
      <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search dealer name, recruiter, category and item name" class="pull-right form-control"> 
    </div> 
  </div>   
  <div class="col-md-6">

    <div  class="inventory-customize-field-container"> 
      <h4> Optional Fields</h4>

      <div class="form-group row"> 
        <div class="col-sm-10">
          <div class="i-checks">
            <input id="checkboxCustom1" type="checkbox" name="dealer_name" class="form-control-custom">
            <label for="checkboxCustom1">Dealer Name</label>
          </div>

          <div class="i-checks">
            <input id="checkboxCustom2" type="checkbox" name="dealer_group" class="form-control-custom">
            <label for="checkboxCustom2">Dealer Group / Recruiter</label>
          </div> 

          <div class="i-checks">
            <input id="checkboxCustom3" type="checkbox" name="category" class="form-control-custom">
            <label for="checkboxCustom3">Category</label>
          </div>

          <div class="i-checks">
            <input id="checkboxCustom4" type="checkbox" name="item_name" class="form-control-custom">
            <label for="checkboxCustom4">Item Name</label>
          </div>  

          <div class="i-checks">
            <input id="checkboxCustom5" type="checkbox" name="tra" class="form-control-custom">
            <label for="checkboxCustom5">TRA #</label>
          </div>

        </div>
      </div> 
    </div>
  </div> 
  <div class="col-md-6">

    <div class="inventory-customize-field-container"> 
      <h4> Optional Fields</h4>

      <div class="form-group row">

        <div class="col-sm-8">
         <div class="i-checks">
          <input id="checkboxCustom6" type="checkbox" name="gross_selling" class="form-control-custom">
          <label for="checkboxCustom6">Gross Selling Price</label>
        </div>       
        <div class="i-checks">
          <input id="checkboxCustom7" type="checkbox" name="dealer_discount" class="form-control-custom">
          <label for="checkboxCustom7">Dealer Discount</label>
        </div>       
        <div class="i-checks">
          <input id="checkboxCustom8" type="checkbox" name="store_profit" class="form-control-custom">
          <label for="checkboxCustom8">Store Profit</label>
        </div>       
        <div class="i-checks">
          <input id="checkboxCustom9" type="checkbox" name="net_amount" class="form-control-custom">
          <label for="checkboxCustom9">Net Amount</label>
        </div>       
        <div class="i-checks">
          <input id="checkboxCustom10" type="checkbox" name="cash_payment" class="form-control-custom">
          <label for="checkboxCustom10">Cash Payment</label>
        </div>              
      </div>

      <div class="col-sm-4">
        <div class="i-checks">
          <input id="checkboxCustom11" type="checkbox" name="date_created" class="form-control-custom">
          <label for="checkboxCustom11">Date</label>
        </div>
      </div>
    </div> 
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
          <table class="table table-striped">
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
                <th>Credit Limit</th>
                <th>Credit Limit Available</th>
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
                  234
                </td>  
                <td class="gross_selling"> 
                  {{$detail->item->price}}
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
                  Php 0.00              
                </td>

                <td>{{ $detail->order->dealer->credit_limit }}</td>
                <td>{{ $detail->order->dealer->credit_balanced }}</td>

                <td class="date_created">  
                  {{ $detail->created_at }}
                </td>                    
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>

        <div style="margin-top: 10px">
          <div class="form-group pull-right">
            <a href="{{ route('export', ['id' => 'receivable']) }}" class="btn-info btn">Generate Excel</a>
          </div>

          <div>
            {{ $orders->links() }}
          </div>
        </div>


      </div>
    </div>
  </div> 
</div>  
</div>
</section>
@endsection
@section('more_script')
<script src="{{ asset('js/reports/receivable.js') }}"></script>
@endsection