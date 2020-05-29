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
              <h1 class="h3 display">Update Category</h1>
          </header>
            
          <div class="row"> 
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Update</h4>
                </div>
                <div class="card-body" id="app">

                    {{ Form::model($category, array('route' => array('category.update', $category->id), 'method' => 'put',  'enctype' => 'multipart/form-data')) }}

                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Photo (optional)</label>
                      <div class="col-sm-10 photo-container" >
                        <img src="/storage/avatars/{{ $category->photo != null ? $category->photo : 'no-image.jpg' }}" alt="item" width="70px" height="75px"/> 
                        <input type="file" name="photo"> 
                       </div>
                    </div>

                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Name</label>
                      <div class="col-sm-10 mb-3"> 
                          
                           <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{$category->name}}" required>
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
                         <input type="number" min="1" value="{{ $category->discount }}" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" name="discount" required>
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
                        <a href="{{ url('category') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
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