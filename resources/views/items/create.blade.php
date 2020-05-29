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
              <h1 class="h3 display">Add Product</h1>
          </header>
            
          <div class="row"> 
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Add product</h4>
                </div>
                <div class="card-body">                  
                {{ Form::open(['route' => 'items.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                      
                   <div class="line"></div>
                        
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Photo (optional)</label>
                      <div class="col-sm-10 photo-container" > 
                        <input type="file" name="photo" value="{{old('photo')}}"> 
                       </div>
                    </div>
                       
                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Category</label>
                      <div class="col-sm-10 mb-3">
                        <select name="category" class="form-control category {{ $errors->has('category') ? 'is-invalid' : ''}}">
                          <option disabled selected>Select Category</option>                         
                          @foreach($categories as $category)

                            <option value="{{$category->id}}" {{request('category') == $category->name ? 'selected' : ''}}>{{ $category->name }}</option>

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
                        <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{old('name')}}" name="name">
 
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
                        <input type="number" class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}" min="1" value="{{old('price')}}" name="price">

                         <div class="field-error-container">
                           <small class="text-danger">
                               {{ $errors->first('price') }}
                           </small>
                         </div>
                          
                       </div>
                    </div>

                    <div class="line"></div>
                    <div class="form-group row">
                      <label class="col-sm-2 form-control-label">Item Quantity</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control {{$errors->has('quantity') ? 'is-invalid' : ''}}" min="1" value="{{old('quantity')}}" name="quantity">

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
                      <label class="col-sm-2 form-control-label">Select Item Attributes</label>
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
                              <div class="col-md-3">
                                <button type="button" class="btn btn-warning btn-sm btn-block radius" id="add-attribute">New Attribute</button>
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
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>                          
                                
                                  <tr v-for="attribute in attributes">
                                    <td>
                                    <div class="i-checks">
                                      <input type="checkbox" @click="selected(attribute.name, attribute.id)" name="attributes[]" :value="attribute.id" :id="attribute.id" class="form-control-custom box">
                                      <label :for="attribute.id">@{{attribute.name}}</label>
                                    </div>

                                    </td>
                                    <td>                                      
                                      <ul>
                                        <li v-for="value in attribute.values">
                                          <a href="#" data-toggle="modal" :data-target="'#edit_value' + value.id" style="text-decoration: none;">@{{ value.attribute_value }}</a>

                                          <!-- Edit attribute value name modal -->
                                          <div :id="'edit_value' + value.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                                            <div role="document" class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 id="exampleModalLabel" class="modal-title">Edit Attribute Value</h5>
                                                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                                </div>        
                                                <div class="modal-body">          
                                                    <label>Attribute Value </label>
                                                    <input class="form-control" :id="'attrvalue_' + value.id" type="text" :value="value.attribute_value">            
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                                  <button type="button" @click.prevent="editValue(value.id)" id="update" class="btn btn-primary">
                                                    Update
                                                  </button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <!-- End Edit attribute value name modal -->
                                        </li>
                                      </ul>                                                                        
                                    </td>
                                    <td>
                                      <button type="button" data-target="#add_attribute" @click="onClickAdd(attribute.id)" :value="attribute.id" data-toggle="modal" class="btn btn-info btn-xs radius"><i class="fa fa-plus"></i>  Add Value
                                      </button>
                                      <button type="button" data-toggle="modal" :data-target="'#edit_' + attribute.id" class="btn btn-info btn-xs radius"><i class="fa fa-pencil"></i> Edit
                                      </button>
                                        <!-- Edit attribute name modal -->
                                        <div :id="'edit_' + attribute.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                                          <div role="document" class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 id="exampleModalLabel" class="modal-title">Edit Attribute</h5>
                                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                              </div>        
                                              <div class="modal-body">          
                                                  <label>Attribute Value </label>
                                                  <input class="form-control" :id="'value_' + attribute.id" type="text" :value="attribute.name" name="value">            
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                                <button type="button" @click.prevent="editAttribute(attribute.id)" id="update" class="btn btn-primary">
                                                  Update
                                                </button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                    </td>            
                                  </tr>
                                  
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