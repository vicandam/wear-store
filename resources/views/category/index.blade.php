
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
            <!-- Page Header-->
            <header>
                <h1 class="h3 display">Product Category</h1>
                <form method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="category" class="form-control">
                                    <option value="">Select category</option>
                                    @foreach($categories as $category)                                      
                                      <option value="{{$category->name}}">{{ $category->name }}</option>            
                                    @endforeach
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
                        <div class="col-md-12">
                            <div class="form-group pull-right"  >
                                <button type="submit" class="btn btn-success" style="margin-right: 5px"> Search </button>
                                <a href="{{ route('category.create') }}" class="btn btn-info">Create</a>
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
                                        <th>Discount</th>
                                        <th>Action</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <img src="/storage/avatars/{{$category->photo != null ? $category->photo : 'no-image.jpg'}}" alt="item" class="" style="width: 50px">
                                            </td>
                                            <td>{{ $category->discount }}</td>
                                            <td>
                                                <span class="edit-container">                                                      
                                                    <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-success btn-sm radius">
                                                      <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                </span>
                                                &nbsp;
                                                <span class="delete-container">

                                                  <button data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm radius">
                                                    <i class="fa fa-trash"></i> Delete
                                                  </button>                                                       
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach                                   
                                    </tbody>
                                </table>
                            </div>

                            {{ $categories->links() }}

                        </div>
                    </div>
                </div>
            </div>        
    </section>
@endsection
@section('more_script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.alert-success').fadeIn().delay(5000).fadeOut();
        });
    </script>
@endsection