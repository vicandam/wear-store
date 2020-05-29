@extends('layouts.app')

@section('content')
    <!-- Breadcrumb-->
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
                                        <option value="{{$category->name}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search"
                                   class="pull-right form-control">
                        </div>
                    </div>

                    <div class="row" style="margin-top:10px">
                        <div class="col-md-12">
                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-success" style="margin-right: 5px"> Search</button>
                                <a href="{{ route('items.create') }}" class="btn btn-info">Create</a>
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
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Available</th>
                                        <th>Category</th>
                                        <th>Dealer Discount</th>
                                        <th>Store Profit</th>
                                        <th>Net Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>
                                                <img
                                                    src="/storage/avatars/{{ $item->photo != null ? $item->photo : 'no-image.jpg' }}"
                                                    alt="item" class="" style="width: 50px">
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $item->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $item->price }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $item->quantity }}
                                                </p>
                                            </td>
                                            <td>{{$item->category->name}}</td>
                                            <td>{{$item->dealer_discount}} %</td>
                                            <td>{{$item->store_profit}}</td>
                                            <td>{{$item->net_amount}}</td>
                                            <td>
                  <span class="edit-container">
                    <a href="{{ route('items.edit', [$item->id]) }}" class="btn btn-success btn-xs radius">
                      <i class="fa fa-pencil"></i> edit
                    </a>
                  </span>
                                                &nbsp;
                                                <span class="delete-container">
                    <button type="submit" data-toggle="modal" data-target="#confirm_{{$item->id}}"
                            class="btn btn-danger radius btn-xs"><i class="fa fa-trash"></i> Delete</button>
                    {{ Form::model($item, array('route' => array('items.destroy', $item->id), 'method' => 'delete')) }}

                                                    @include('include.modals.confirm', ['id' => $item->id, 'data' => $item->name])

                                                    {{ Form::close() }}
                    
                  </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{  $items->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('more_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.alert-success').fadeIn().delay(5000).fadeOut();
        });
    </script>
@endsection
