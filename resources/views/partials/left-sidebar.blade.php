
<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img src="{{ asset('img/avatar-2.jpg') }}" alt="person" class="img-fluid rounded-circle">
                <h2 class="h5">{{ auth()->user()->name }}</h2>
                <span>
                    {{--Web Developer--}}
                </span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="{{ url('/') }}" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>

        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li>
                    <a href="{{ route('dealers.index') }}" class="link" aria-expanded="false">
                        <i class="fa fa-group"></i>
                        Dealers
                    </a>                    
                </li>

                <li>
                    <a href="{{ route('category.index') }}" class="link" aria-expanded="false">
                        <i class="fa fa-list-alt"></i>
                        Categories
                    </a>                    
                </li>

                <li>
                    <a href="{{ route('items.index') }}" class="link" aria-expanded="false">
                        <i class="fa fa-shopping-bag"></i>
                        Items
                    </a>                    
                </li>

                <li>
                    <a href="#orders" aria-expanded="false" data-toggle="collapse">
                        <i class="fa fa-cart-plus"></i>
                        Orders
                    </a>
                    <ul id="orders" class="collapse list-unstyled ">
                        <li><a href="{{ route('orders.index') }}" class="link">List</a></li>
                        <li><a href="{{ route('orders.create') }}" class="link">Add</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#reports" aria-expanded="false" data-toggle="collapse">
                        <i class="fa fa-print"></i>
                        Reports
                    </a>
                    <ul id="reports" class="collapse list-unstyled ">
                        <li><a href="{{ url('sales-report') }}" class="link">Sales Report</a></li>
                        <li><a href="{{ url('receivable') }}" class="link">Receivable</a></li>
                        <li><a href="{{ route('inventory', ['inventory' => 'true']) }}" class="link">Inventory</a></li>
                    </ul>                    
                </li>
            </ul>
        </div>


        {{----}}


        {{--<!-- Sidebar Navigation Menus-->--}}
        {{--<div class="main-menu">--}}
            {{--<h5 class="sidenav-heading">Main</h5>--}}
            {{--<ul id="side-main-menu" class="side-menu list-unstyled">--}}
                {{--<li><a href="index.html"> <i class="icon-home"></i>Home </a></li>--}}
                {{--<li><a href="forms.html"> <i class="icon-form"></i>Forms </a></li>--}}
                {{--<li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts</a></li>--}}
                {{--<li class="active"><a href="tables.html"> <i class="icon-grid"></i>Tables</a></li>--}}
                {{--<li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>--}}
                    {{--<ul id="exampledropdownDropdown" class="collapse list-unstyled ">--}}
                        {{--<li><a href="#">Page</a></li>--}}
                        {{--<li><a href="#">Page</a></li>--}}
                        {{--<li><a href="#">Page</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a href="login.html"> <i class="icon-interface-windows"></i>Login page</a></li>--}}
                {{--<li> <a href="#"> <i class="icon-mail"></i>Demo--}}
                        {{--<div class="badge badge-warning">6 New</div></a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}

        {{----}}
        {{--<div class="admin-menu">--}}
            {{--<h5 class="sidenav-heading">Second menu</h5>--}}
            {{--<ul id="side-admin-menu" class="side-menu list-unstyled">--}}
                {{--<li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>--}}
                {{--<li> <a href="#"> <i class="icon-flask"> </i>Demo--}}
                        {{--<div class="badge badge-info">Special</div></a></li>--}}
                {{--<li> <a href=""> <i class="icon-flask"> </i>Demo</a></li>--}}
                {{--<li> <a href=""> <i class="icon-picture"> </i>Demo</a></li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    </div>
</nav>
