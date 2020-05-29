
@extends('layouts.app')

@section('content')
    <!-- breadcrumb-->
    <div class="breadcrumb-holder">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Tables</li>
            </ul>
        </div>
    </div>

    <div class="container">
        @include('include.partials.success')        
    </div>

    <!-- Content -->
    <section>
        <div class="container-fluid">
            <div id="vue-wrapper">
            <!-- Page Header-->
            <header>
                <h1 class="h3 display">Product Category</h1>
                <form method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="category" class="form-control">
                                    <option value="">Select category</option>
                                    <option v-for="category in categories" :value="category.name">@{{ category.name }}</option>              
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="keyword" placeholder="Search" class="pull-right form-control" value="{{ request('keyword') }}">
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
                            <h4>Categories</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Action</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="category in categories">
                                            <td>@{{ category.name }}</td>
                                            <td>
                                                <img :src="'/storage/avatars/' + category.photo" alt="item" class="" style="width: 50px">
                                            </td>
                                            <td>
                                                  <span class="edit-container">                                                      
                                                      <button id="show-modal" @click="showModal=true; setVal(category.id, category.name)" class="btn btn-success btn-sm radius">
                                                        <i class="fa fa-pencil"></i> Edit
                                                      </button>
                                                  </span>
                                                  &nbsp;
                                                  <span class="delete-container">

                                                    <button data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm radius">
                                                      <i class="fa fa-trash"></i> Delete
                                                    </button>                                                       
                                                  </span>
                                            </td>
                                        </tr>
                                    
                                    </tbody>
                                </table>

                            </div>                              

                            <modal v-if="showModal" @close="showModal=false">
                                <h3 slot="header">Edit Items</h3>
                                <div slot="body">
                                    
                                    <input type="hidden" id="e_id" disabled class="form-control" required :value="this.e_id" name="id">
                                    <input type="text" id="e_name" class="form-control" required :value="this.e_name" name="name">
                                    
                                  
                                </div>
                                <div slot="footer">
                                    <button class="btn btn-default" @click="showModal = false">
                                    Cancel
                                  </button>
                                  
                                  <button class="btn btn-info" @click="editItem()">
                                    Update
                                  </button>                                 
                                  

                                </div>
                            </modal>                                          

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- vue wrapper -->
            </div>

<!-- <template id="example-modal"> -->
    
  <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="exampleModalLabel" class="modal-title">Confirm to delete record</h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          
          <p>This is modal body.</p>
          
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </div>
    </div>
  </div>

<!-- </template> -->
        
    </section>
@endsection
@section('more_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.alert-success').fadeIn().delay(5000).fadeOut();
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/categories.js') }}"></script>

    <script  id="modal-template">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  default header
                </slot>
              </div>

              <div class="modal-body">
                <slot name="body">
                    
                </slot>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  
                  
                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </script>
    
@endsection
