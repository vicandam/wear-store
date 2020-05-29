
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
                <h1 class="h3 display">Recruiter</h1>
                <form method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="recruiter" class="form-control">
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
                            <h4>Items</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>                                        
                                        <th>Date</th>                                        
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>                                            
                                            <th scope="row">
                                                
                                            </th>
                                            <td>
                                                <p>
                                                    
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    
                                                </p>
                                            </td>
                                            <td>
                                                <div class="button-container">
                                                    <a href="{{ route('dealers.edit', ['id' => $user->dealer->id]) }}" class="btn btn-success btn-sm radius"><i class="fa fa-pencil"></i> Edit</a>                                                    
                                                    &nbsp;                                                    
                                                    <button type="button" data-toggle="modal" data-target="#" class="btn btn-danger btn-sm radius"><i class="fa fa-trash"></i> Pay</button>

                                                        {{-- Form::model($user, array('route' => array('dealers.destroy', $user->dealer->id), 'method' => 'delete')) --}}
                                                                
                                                        
                                                        {{--@include('include.modals.confirm', ['id' => $user->dealer->id, 'data' => $user->name])--}}                                                                       
                                                        {{-- Form::close() --}}                                                      
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {{  $users->links() }}

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
            $('.alert-success').fadeIn().delay(5000).fadeOut();
        });
    </script>
@endsection
