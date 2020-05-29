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
    <section class="forms mt-5">
        <div id="vue-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>Dealers</h4>
                            </div>
                            <div class="card-body">
                                <div class="line"></div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-control-label">Choose Dealer Name</label>
                                    <div class="col-sm-10 mb-3">
                                        <input type="hidden" name="dealer" id="dealer">
                                        <select name="dealer_id" @change="getDealersCreditLimit" class="form-control"
                                                id="dealer_id">
                                            <option disabled selected>Select dealer</option>
                                            @foreach($dealers as $dealer)
                                                <option
                                                    value="{{$dealer->id}}" {{ request('dealer_id') == $dealer->id ? 'selected' : '' }}>{{$dealer->user->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            :class="['field-error-container ', ( showError == true ? '' : 'display-none') ]">
                                            <small class="text-danger">
                                                Dealer has no credits
                                            </small>
                                        </div>

                                    </div>
                                </div>

                                <div class="line"></div>
                                <div :class="{'form-group row display-none':hasNoCredit}">
                                    <div class="col-sm-4 offset-sm-2">
                                        <button id="next" class="btn btn-primary" @click.prevent="addOrderId"> Ready to
                                            order
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="show-items" class="green-border">
                    <div class="item-search">
                        <div class="col-lg-12">
                            <header id="header">
                                <h1 class="h3 display">Search items</h1>
                                <form method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="category" class="form-control">
                                                    <option value="">Select category</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->name}}"> {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="keyword" value="{{ request('keyword') }}"
                                                       placeholder="Search"
                                                       class="pull-right form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success"> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </header>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Items</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="orders" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Available</th>
                                            <th>Quantity</th>
                                            <th>Attribute</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($items as $item)
                                            <tr>
                                                <th scope="row">{{ $item->id }}</th>
                                                <td>
                                                    <img src="/storage/avatars/{{ $item->photo }}" alt="category"
                                                         class="" style="width: 50px">
                                                </td>
                                                <td>
                                                    <p>
                                                        {{ $item->name }}
                                                    </p>
                                                </td>
                                                <td>
                                <span>
                                   {{ $item->category->name }}
                               </span>
                                                </td>
                                                <td>
                                <span>
                                   <p id="item_{{$item->id}}">{{ number_format($item->price, 2) }}</p>
                               </span>
                                                </td>
                                                <td>
                                                    <p id="qty_{{$item->id}}">
                                                        {{ $item->quantity }}
                                                    </p>
                                                </td>
                                                <td width="5%">
                                                    <input type="number" min="1" name="quantity"
                                                           class="form-control qty_{{$item->id}}" value="1">
                                                </td>
                                                <td>
                                                    @foreach($item->item_attributes as $item_attribute)

                                                        <select class="form-control attr_{{$item->id}}"
                                                                id="attribute_{{$item_attribute->id}}"
                                                                name="attributes[]">
                                                            <option selected disabled>
                                                                Select {{$item_attribute->attribute->name}}</option>
                                                            @foreach($values as $value)

                                                                @if($item_attribute->attribute->id == $value->attribute_id)
                                                                    <option
                                                                        value="{{ $value->id }}">{{ $value->attribute_value }}</option>
                                                                @endif

                                                            @endforeach
                                                        </select>

                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            id="{{$item->id}}"
                                                            value="{{$item->id}}"
                                                            price="{{$item->price}}"
                                                            item="{{$item->name}}"
                                                            class="btn btn-success btn-sm radius"
                                                            data-toggle="modal"
                                                            data-target="#confirm_{{$item->id}}">
                                                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                                        Add
                                                    </button>
                                                    @include('include.modals.confirm_order',
                                                    [
                                                    'id' => $item->id,
                                                    'item' => $item->name,
                                                    'price' => $item->price,
                                                    'quantity' => $item->quantity
                                                    ])
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                {{ $items->links() }}

                            </div>
                        </div>
                    </div>
                </div>

                <!-- New orders list -->
                <div id="pending-orders" class="green-border mt-3">
                    <div class="col-lg-12 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fa fa-cart-plus" aria-hidden="true"></i> New Orders</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Item id</th>
                                            <th>Item Name</th>
                                            <th>Item Attributes</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="order in orders.order_details">
                                            <td :class="order.item_id">@{{order.item_id}}</td>
                                            <td>@{{ order.item.name }}</td>
                                            <td>
                                                <ul v-for="attribute in order.item_attributes">
                                                    <li>@{{ attribute.attribute.name }} : @{{
                                                        attribute.attribute_value.attribute_value }}
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>@{{ order.item.price }}</td>
                                            <td>
                                                <p>
                                                    @{{ order.quantity }}
                                                </p>
                                            </td>
                                            <td>Php @{{ order.item.price * order.quantity }}</td>
                                            <td>
                                                <p>@{{ order.created_at }}</p>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm radius"
                                                        @click="removeNewOrder(order.id, order.order_id, order.item_id, order.item.price, order.quantity)">
                                                    <i class="fa fa-trash"></i> Cancel
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div>
                                    <strong>Ordered Total:
                                        <label class="total-amount" id="total" v-text="total_order_in_cart"></label>
                                    </strong>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div>
                                    <button data-toggle="modal" @click="getDealersLatestCredit"
                                            data-target="#confirm_order"
                                            id="proceed_to_order" class="btn btn-success btn-sm radius">Confirm Order
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{ Form::open(['route' => 'receipt', 'method' => 'get']) }}

                        @include('include.modals.proceed_order')

                        {{ Form::close() }}

                    </div>
                </div>
                <!-- End New orders list -->

                <!-- Pending orders list -->
                <div id="pending-orders-old" :class="['row', {'display-none':noPending}]">
                    <div class="col-lg-12">
                        <div class="notes"><h2>To create new orders you should complete or clear pending orders</h2>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4><i class="fa fa-cart-plus" aria-hidden="true"></i> Pending Orders</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Order id</th>
                                            <th>Item id</th>
                                            <th>Item Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr v-for="order in pending.order_details">
                                            <td>@{{ order.order_id }}</td>
                                            <td>@{{ order.item_id}}</td>
                                            <td>@{{ order.item.name }}</td>
                                            <td>Php @{{ order.item.price }}</td>
                                            <td>
                                                <p>
                                                    @{{ order.quantity }}
                                                </p>
                                            </td>
                                            <td class="total">
                                                Php @{{ order.item.price * order.quantity }}
                                            </td>

                                            <td>
                                                <p>@{{ order.created_at }}</p>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm radius"
                                                        @click="removePendingOrder(order.id, order.order_id, order.item_id, order.item.price, order.quantity)">
                                                    <i class="fa fa-trash"></i>
                                                    Cancel
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <div class="from-group">
                            <div class="pull-left">
                                <strong>
                                    Ordered Total:

                                    <label class="total-amount">
                                        Php @{{ amount }}
                                    </label>
                                </strong>
                            </div>
                            <div class="pull-right">
                                {{ Form::open(['route' => 'receipt', 'method' => 'get']) }}

                                <button type="submit" name="receipt" :value="pending.id"
                                        @click="completeOrder(pending.id)"
                                        class="btn btn-success btn-sm radius">
                                    Complete this order
                                </button>

                                {{ Form::close() }}
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Pending orders list -->

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
    <script type="text/javascript" src="{{ asset('js/create-orders.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/create-order/create.js') }}"></script>
    <script type="text/javascript">
        $('#dealer_id').change(function () {
            localStorage.setItem('dealer', $(this).val());
        });

        $(document).ready(function () {
            $('.search-items').hide();
            var dealer = localStorage.getItem('dealer');
            console.log(dealer);
            if (dealer != null) {
                $('#dealer_id').val(dealer);
                $('#show-items').show();
            }
        });
    </script>
@endsection
