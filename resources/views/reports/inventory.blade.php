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
      <h1 class="h3 display">Items</h1> 
      <form method="GET">
        <div class="row">
          <div class="col-md-6"> 
           <div class="form-group">
            <select name="category_name" class="form-control">              
              <option value="">Select all category</option>
              @foreach($categories as $category)
              <option value="{{$category->name}}" {{ request('category_name') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>            
              @endforeach
            </select>
          </div>
        </div>      

        <div class="col-md-6">
          <div class="form-group">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search" class="pull-right form-control">
          </div> 
        </div>

        <div class="col-md-6">  
         <div class="form-group"  >
          <button type="submit" class="btn btn-success"> Search </button>
        </div>
      </div>  
    </form>
  </header>
  <div class="col-md-6">                          
    <div  class="inventory-customize-field-container"> 
      <h4> Optional Fields</h4>

      <div class="form-group row"> 
        <div class="col-sm-10">
          <div class="i-checks">
            <input id="checkboxCustom1" type="checkbox" name="category" class="form-control-custom">
            <label for="checkboxCustom1">Category</label>
          </div>

          <div class="i-checks">
            <input id="checkboxCustom2" type="checkbox" name="name" class="form-control-custom">
            <label for="checkboxCustom2">Name</label>
          </div> 

          <div class="i-checks">
            <input id="checkboxCustom3" type="checkbox" name="dealer_discount" class="form-control-custom">
            <label for="checkboxCustom3">Dealer Discount</label>
          </div>

          <div class="i-checks">
            <input id="checkboxCustom4" type="checkbox" name="store_profit" class="form-control-custom">
            <label for="checkboxCustom4">Store Profit</label>
          </div>  

          <div class="i-checks">
            <input id="checkboxCustom5" type="checkbox" name="net_amount" class="form-control-custom">
            <label for="checkboxCustom5">Net Amount</label>
          </div>

          <div class="i-checks">
            <input id="checkboxCustom6" type="checkbox" name="available" class="form-control-custom">
            <label for="checkboxCustom6">Available</label>
          </div> 
        </div>
      </div> 
    </div>
  </div> 
</div>

<div class="row">  
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Items</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          @include('reports.table.inventory')
        </div>

        <div style="margin-top: 10px">
          <div class="form-group pull-right">
            <a href="{{ route('export.inventory', ['id' => 'inventory']) }}" class="btn-info btn">Generate Excel</a>
          </div>

          <div>
            {{  $items->links() }}
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
  <script src="{{ asset('js/inventory/checkboxes.js') }}"></script>
@endsection