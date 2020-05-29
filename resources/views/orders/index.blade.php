
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
                <h1 class="h3 display">Orders</h1>
                <form method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="dealer" class="form-control">
                                    <option value="">Select dealer</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->name}}">{{$user->name}}</option>
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
                            <h4>Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Order id</th>  
                                        <th>Dealer</th>                                   
                                        <th>Date</th>                                                                               
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <th>{{ $order->dealer->user->name }}</th>
                                            <th scope="row">{{ $order->created_at }}</th>
                                            <td>{{ $order->status }}</td>
                                            <td>
                                                <div class="button-container">
                                                    <button type="button" data-toggle="modal" data-target="#order_details_{{$order->id}}" class="btn btn-info btn-sm radius"><i class="fa fa-eye"></i> View details</button>

                                                    <!-- view details modal-->
                                                    @include('include.modals.order_details_list', ['id' => $order->id, 'total' => $total])
                                                    
                                                </div>
                                            </td>                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{  $orders->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </section>

    <!-- confirm payment modal -->
    {{--@include('include.modals.confirm_payment')--}}

@endsection
