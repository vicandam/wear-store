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

                    {{ Form::model($dealer, array('route' => array('dealers.update', $dealer->id), 'method' => 'put')) }}

                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Name</label>
                      <div class="col-sm-10 mb-3"> 
                          
                           <input type="text" class="form-control" name="name" value="{{$dealer->user->name}}" required>
                            <!-- <div class="field-error-container">
                             <small class="text-danger">
                                 Please provide category
                             </small>
                            </div> -->
                             
                      </div>  
                    </div>
                       
                     <div class="line"></div>
                        
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Dealer Group / Recruiter</label>
                      <div class="col-sm-10">
                          
                        <select name="dealer_group_recruiter" class="form-control" >
                          <option disabled selected>Select group/recruiter</option>
                          @foreach($users as $user)
                          <option value="{{$user->name}}">{{ $user->name }}</option>
                          @endforeach
                        </select>
                          
                        <!-- <div class="field-error-container">
                           <small class="text-danger">
                               Please provide category
                           </small>
                        </div> -->
                       </div>
                    </div>
                    
                    <div class="line"></div>
                        
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Address</label>
                      <div class="col-sm-10">    
                          <input type="text" class="form-control" name="address" value="{{$dealer->address}}" required> 
                         <!-- <div class="field-error-container">
                           <small class="text-danger">
                               Please provide category
                           </small>
                         </div> -->
                          
                       </div>
                    </div>
                      
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Contact Number</label>
                      <div class="col-sm-10 mb-3"> 
                         <input type="text" class="form-control" name="contact_number" value="{{$dealer->contact_number}}" required> 
                         <!-- <div class="field-error-container">
                           <small class="text-danger">
                               Please provide category
                           </small>
                         </div> -->
                          
                          
                      </div> 
                    </div>
                       
                     <div class="line"></div>
                      
                     <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Email Address</label>
                          <div class="col-sm-10 mb-3">
                              
                                <input type="email" class="form-control" name="email" value="{{ $dealer->user->email }}" required> 
                              
                              

                             <!-- <div class="field-error-container">
                               <small class="text-danger">
                                   Please provide category
                               </small>
                             </div> -->
                          </div> 
                     </div> 
                      
                   <div class="line"></div>
                      
                    <div class="form-group row">
                      <label class="col-lg-2 form-control-label">Credit Limit</label>
                      <div class="col-lg-10">
                        <input  type="number" name="credit_limit" value="{{$dealer->credit_limit}}" class="form-control" required> 
                         <!-- <div class="field-error-container">
                           <small class="text-danger">
                               Please provide category
                           </small>
                         </div> --> 
                      </div>
                    </div>
                       
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">                        
                        <a href="{{ url('dealers') }}" class="btn btn-secondary">Cancel</a>
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