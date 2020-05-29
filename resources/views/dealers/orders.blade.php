
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
            <h1 class="h3 display">Orders</h1>
            <form method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option disabled selected>Select status</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="pending">Pending</option>
                                <option value="completed">Ordered</option>
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

        <div class="payments" {!! $payables == 0 ? 'style="display: none"' : '' !!}>
            <div class="panel-white" style="margin-bottom: 10px;">
                
                    Total Ordered: Php
                    <label class="label payables" id="{{$payables}}"><u>{{ number_format($payables, 2) }}</u></label>
                
                <br>
                
                    Total Paid: Php 
                    <label class="label paid"><u>{{ number_format($total_paid, 2) }}</u></label>
                
                    <br>
                
                    Balance: Php
                    <label class="label balance"><u>{{ number_format($payables - $total_paid, 2) }} </u></label>
                
              </div>
        </div>            

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
                                        <th>Date</th>
                                        <th>Payable</th>                                        
                                        <th>Total Paid</th>
                                        <th>Balance</th>                                       
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($orders))
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>                               
                                        <th scope="row">{{ $order->created_at }}</th>
                                        <td class="payable_{{$order->id}}">{{ number_format($total[$order->id], 2) }}</td>
                                        <td class="total_{{$order->id}}">
                                            {{
                                                @$order->payment_details[0]->total != null ? number_format(@$order->payment_details[0]->where('order_id', $order->id)->sum('total'), 2) : ''

                                            }}
                                        </td>
                                        <td class="balance_{{$order->id}}">
                                            {{
                                                @$order->payment_details[0]->total != null ? number_format( $total[$order->id] - (@$order->payment_details[0]->where('order_id', $order->id)->sum('total')), 2) : ''
                                            }}
                                        </td>                                      
                                        <td class="status_{{$order->id}}">{{ $order->status == 'completed' ? 'ordered' : $order->status }}</td>
                                        <td>
                                            <div class="button-container">
                                                <button type="button" view="{{$order->id}}" data-toggle="modal" data-target="#order_details_{{$order->id}}" class="btn btn-info btn-sm radius view">
                                                    <i class="fa fa-eye"></i> View details
                                                </button>   

                                                <!-- view order details modal-->
                                                @include('include.modals.order_details', ['id' => $order->id, 'quantity' => @$order->order_details[0]->quantity, 'order' => $order, 'total' => $total, 'item' => @$order->order_details[0]->item_id])

                                                &nbsp;                                                    
                                                @if($order->status == 'completed' || $order->status == 'paid')
                                                    <button type="button" id="{{$order->id}}" value="{{$total[$order->id]}}" data-toggle="modal" data-target="#confirm_payment-{{$order->id}}" class="btn btn-success btn-sm radius paynow">
                                                        <i class="fa fa-usd"></i> Pay Now
                                                    </button>

                                                    <!-- confirm payment modal -->
                                                    @include('include.modals.confirm_payment', ['id' => $order->id, 'dealer' => $order->dealer_id, 'quantity' => @$order->order_details[0]->quantity, 'order' => $order, 'total' => $total])

                                                @else
                                                    <button type="button" class="disabled btn btn-success btn-sm radius paynow">
                                                        <i class="fa fa-usd"></i> Pay Now
                                                    </button>
                                                @endif
                                            </div>
                                        </td>                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $orders->links() }}

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

        $('.paynow').click(function() {
            var id = $(this).attr('id');
            var balance = $('.balance_'+id).text().trim();
            
            $('input[name=order_id]').val(id);
            $('#total_'+id).val(parseFloat((balance).replace(/,/g, '')));

            $('#confirm_payment-'+id).on('shown.bs.modal', function() {
                $('#total_'+id).focus();                
            });
        });

        $('.view').click(function() {
            var id = $(this).attr('view');

            var balance = $('.balance_'+id).text();

            if (balance == '0.00') {
                $('.status_'+id).text('paid');                
            }
        });

        $('.proceed').click(function(e) {

            e.preventDefault();
            var id = $(this).attr('id');
            var url = "{{ url('pay-order') }}";
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var total = $('#total_'+id).val();
            var order_id = $('input[name=order_id]').val();
            var dealer_id = $('input[name=dealer_id').val();           

            $.ajax({

                type: 'post',
                url: url,
                dataType: 'json',
                data: {total:total,order_id:order_id,dealer_id:dealer_id,"_token":csrf_token},
                success:function(data) {
                    
                    $('.modal').modal('hide');
                    
                    var payable = $('.payable_'+id).text();
                    var balance = parseFloat((payable).replace(/,/g, '')) - parseFloat(data.total_paid);
                    var total_ordered = $('.payables').attr('id');
                    var paid = parseFloat(data.all_paid);
                    var total_balanced = total_ordered - paid;

                    console.log('Ordered: '+total_ordered);
                    console.log('Paid: '+paid);
                    console.log('Balance: '+total_balanced);

                    $('.total_'+order_id).text(parseFloat(data.total_paid).toFixed(2));
                    $('.balance_'+id).text(parseFloat(balance).toFixed(2));
                    $('.paid').text(parseFloat(data.all_paid).toFixed(2)).css('text-decoration', 'underline');
                    $('.balance').text(parseFloat(total_balanced).toFixed(2)).css('text-decoration', 'underline');
                    $('.status_'+order_id).text(data.status);

                    $('.modal_paid_'+id).text('Paid: Php '+parseFloat(data.total_paid).toFixed(2));                    
                    $('.modal_balance_'+id).text('Balanced: Php '+parseFloat(balance).toFixed(2));                   
                    
                    Command: toastr["success"](data.message);

                },
                error:function(error) {
                    var errors = error.responseJSON.errors;
                    for (var i in errors)
                    {
                        var total = errors[i].total;

                    }
                    Command: toastr["error"](errors.total);
                    console.log(errors);
                }

            });

        });
    });
</script>
@endsection
