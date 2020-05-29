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
              <h1 class="h3 display">Update Product</h1>
          </header>
            
          <div class="row"> 
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Update product</h4>
                </div>
                <div class="card-body">                  
                
                {{ Form::model($items, array('route' => array('items.update', $items->id), 'method' => 'put', 'enctype' => 'multipart/form-data')) }}
                   <div class="line"></div>
                        
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Photo (optional)</label>
                      <div class="col-sm-10 photo-container" > 

                        <img src="/storage/avatars/{{ $items->photo != null ? $items->photo : 'no-image.jpg' }}" alt="item" width="70px" height="75px"/>                      
                        <input type="file" id="photo" class="hidden" name="photo" value="{{$items->photo}}"> 

                       </div>
                    </div>
                       
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Category</label>
                      <div class="col-sm-10 mb-3">
                        <select name="category" class="form-control {{$errors->has('category') ? 'is-invalid' : ''}}">                          
                          @foreach($categories as $category)

                            <option value="{{$category->id}}" {{ $items->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>

                          @endforeach
                        </select> 
                        <div class="field-error-container">
                           <small class="text-danger">
                               {{ $errors->first('category') }}
                           </small>
                         </div>
                      </div>  
                    </div>
                       
                     <div class="line"></div>
                        
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Item Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ $items->name }}">
 
                        <div class="field-error-container">
                           <small class="text-danger">
                               {{ $errors->first('name') }}
                           </small>
                        </div>
                       </div>
                    </div>
                    
                    <div class="line"></div>
                        
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Item Price</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}" name="price" value="{{ $items->price }}">

                         <div class="field-error-container">
                           <small class="text-danger">
                               {{ $errors->first('price') }}
                           </small>
                         </div>
                          
                       </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Item Quantity</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control {{$errors->has('quantity') ? 'is-invalid' : ''}}" name="quantity" value="{{ $items->quantity }}">

                         <div class="field-error-container">
                           <small class="text-danger">
                               {{$errors->first('quantity')}}
                           </small>
                         </div>
                          
                       </div>
                    </div>

                    <div id="vue-wrapper">
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Item Attributes</label>
                      <div class="col-sm-6 attribute">
                        <input type="text" name="attribute" id="attribute" class="form-control">
                      </div>
                      <div class="col-sm-4">                        
                        <button type="button" class="btn btn-warning radius" id="save-attribute" @click="saveAttribute">Save</button>
                        <button type="button" class="btn btn-danger radius" id="cancel">Close</button>
                      </div>
                    </div>

                    <div class="line"></div>                    
                      <div class="form-group row">
                        <div class="col-sm-2">
                          <!-- Attributes -->
                        </div>
                        <div class="col-sm-10">
                        <div class="card">
                          <div class="card-header">
                            <div class="row">
                              <div class="col-md-9">
                                <h4><i class="fa fa-edit" aria-hidden="true"></i> Item Attributes</h4>
                              </div>                              
                            </div>                            
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>                                                  
                                    <th>Attribute name</th>
                                    <th>Value</th>                                    
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $attribute)
                                   <?php
                                      $match = false;
                                      foreach ($attribute->item_attributes->where('item_id', $id) as $item) {
                                        $match = true;
                                      }
                                    ?>
                                     <tr>
                                       <td>
                                          <div class="i-checks">                     
                                            <input type="checkbox" {{$match == true ? 'checked' : ''}} name="attributes[]" value="{{$attribute->id}}" id="{{$attribute->id}}" class="form-control-custom box">
                                            <label for="{{$attribute->id}}">{{$attribute->name}}</label>
                                          </div>
                                        </td>
                                        <td>                              
                                        <ul {!! $match == true ? 'style="color: #33b35a"' : ''!!}>
                                          @foreach($attribute->values as $value)
                                          <li>
                                            {{ $value->attribute_value }}
                                          </li>
                                          @endforeach
                                        </ul>                                                          
                                      </td>
                                     </tr>                                  
                                  @endforeach
                                </tbody>
                              </table>
                            </div>                              
                          </div>
                        </div>
                        </div>
                      </div>
                      @include('include.modals.add_attribute_value')
                    </div>
                       
                    <div class="line"></div>
                    <div class="form-group row">
                      <div class="col-sm-4 offset-sm-2">
                        <a class="btn btn-secondary" href="{{ url('items') }}">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  
                  {{ Form::close() }}

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
  <script src="{{ asset('js/create-item.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#save').on('click', function() {
            $('#add_attribute').modal('toggle');
        });
        
        $('.attribute').hide();
        $('#save-attribute').hide();
        $('#cancel').hide();

        $('#cancel').click(function() {
            $('#add-attribute').show();
            $(this).hide();
            $('.attribute').hide();
            $('#save-attribute').hide();
        });

        $('#add-attribute').click(function() {
            $('.attribute').show();
            $('#cancel').show();
            $('#save-attribute').show();
            $(this).hide();
            $('#attribute').focus();
        });
    });
  </script>
@endsection