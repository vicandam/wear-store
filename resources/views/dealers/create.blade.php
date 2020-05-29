@extends('layouts.app')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Forms       </li>
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
      <h1 class="h3 display">Add Dealer</h1>
    </header>
    
    <div class="row"> 
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4>Add Dealer</h4>
          </div>
          <div class="card-body" id="app">               

            {{ Form::open(['route' => 'dealers.store', 'method' => 'post']) }}

            <div class="line"></div>
            <div class="form-group row">
              <label class="col-sm-2 form-control-label">Name</label>
              <div class="col-sm-10 mb-3">
               <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>               
               <div class="field-error-container">
                 <small class="text-danger">
                   {{ $errors->first('name') }}
                 </small>
               </div>               
             </div>  
           </div>

           <div class="line"></div>
           <div class="form-group row">
            <label class="col-sm-2 form-control-label">Dealer Group / Recruiter</label>
            <div class="col-sm-10">
              <select name="dealer_group_recruiter" class="form-control" >
                  <option value="Store Walk-In">Store Walk-In</option>
                @foreach($users as $user)
                    <option value="{{$user->name}}">{{ $user->name }}</option>
                @endforeach
              </select>

            </div>
          </div>

          <div class="line"></div>

          <div class="form-group row">
            <label class="col-sm-2 form-control-label">Address</label>
            <div class="col-sm-10">    
              <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" value="{{ old('address') }}" required> 
              <div class="field-error-container">
               <small class="text-danger">
                 {{ $errors->first('address') }}
               </small>
             </div>

           </div>
         </div>

         <div class="line"></div>
         <div class="form-group row">
          <label class="col-sm-2 form-control-label">Contact Number</label>
          <div class="col-sm-10 mb-3"> 
           <input type="text" onkeypress="return isNumberKey(event)" class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" id="contact" maxlength="11" name="contact_number" value="{{ old('contact_number') }}" required> 
           <div class="field-error-container">
             <small class="text-danger">
               {{ $errors->first('contact_number') }}
             </small>
           </div>
         </div> 
       </div>

       <div class="line"></div>
       <div class="form-group row">
          <label class="col-sm-2 form-control-label">Email</label>
          <div class="col-sm-10 mb-3">
           <input type="email" class="form-control" name="email" value="{{ old('name') }}">             
         </div>  
       </div>                

     <div class="line"></div>

     <div class="form-group row">
      <label class="col-lg-2 form-control-label">Credit Limit</label>
      <div class="col-lg-10">
        <input  type="number" maxlength="5" name="credit_limit" class="form-control {{ $errors->has('credit_limit') ? 'is-invalid' : '' }}" value="{{ old('credit_limit') }}" required> 
        <div class="field-error-container">
         <small class="text-danger">
           {{ $errors->first('credit_limit') }}
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

  function isNumberKey(evt)
  {
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

  return true;
}

$(document).ready(function() {
  $('.alert-danger').fadeIn().delay(5000).fadeOut();

  $('#save').click(function(e) {
    if ($('input[name="email"]').val() == '') {
        var name = $('input[name="name"]').val().toLowerCase();
        var email = name.replace(/\s/g, '');
        $('input[name="email"]').val('no_email'+'@gmail.com');
    }
  });

});
</script>
@endsection
