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

<div class="container">
  @include('include.partials.errors')
</div>

<section class="forms">
  <div class="container-fluid">
    <!-- Page Header-->
    <header> 
      <h1 class="h3 display">Add Category</h1>
    </header>

    <div class="row"> 
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Add Category</h4>
          </div>
          <div class="card-body" id="app">

            {{ Form::open(['route' => 'category.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

            <div class="line"></div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label">Photo (optional)</label>
              <div class="col-sm-10 photo-container" > 
                <input type="file" name="photo"> 
              </div>
            </div>

            <div class="line"></div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label">Name</label>
              <div class="col-sm-10 mb-3"> 
               <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" required>
               <div class="field-error-container">
                 <small class="text-danger">
                   {{ $errors->first('name') }}
                 </small>
               </div>
             </div>
           </div>

           <div class="line"></div>
           <div class="form-group row">
              <label class="col-sm-2 form-control-label">Dealer Discount [ % ]</label>
              <div class="col-sm-10 mb-3"> 
               <input type="number" min="1" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" name="discount" required>
               <div class="field-error-container">
                 <small class="text-danger">
                   {{ $errors->first('discount') }}
                 </small>
               </div>                           
             </div>
           </div>

         <div class="line"></div>
         <div class="form-group row">
          <div class="col-sm-4 offset-sm-2">
            <button type="submit" class="btn btn-secondary">Cancel</button>
            <button type="submit" id="save" class="btn btn-primary">Save changes</button>
          </div>
        </div>

        {{ Form::close() }}

      </div>
    </div>
  </div>
</div>
</div>
</section>
@endsection

@section('more_script')
<script type="text/javascript">
  $(document).ready(function() {
    $('.alert-danger').fadeIn().delay(5000).fadeOut();
  });
</script>
@endsection