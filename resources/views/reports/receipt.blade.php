<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
      <!-- Bootstrap CSS-->
      <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>

    <div class="container">

        <div class="row">

            <div class="col-md-12"  style="text-align: center">

                  <div>
                      <img src="https://www.incimages.com/uploaded_files/image/970x450/products_364475.jpg" style="height: 300px">
                  </div>

                  <br>

                  <div class="">
                      <h1> D' Golden Wear Store </h1>
                      <p>Purok #8 Buru-un, Iligan City</p>
                      <p>Tell #: 223-7158</p>
                      <p>Cell #: 09065-728-9261</p>
                      <em>DEALER of Natasha and MSE products</em>
                  </div>

                <br>

                <div style="background-color:black; width:30%; margin:0px auto; color:white; border-radius: 10px; padding:5px; font-size:18px">
                   TRUST RECEIPT AGREEMENT
                </div>

                <br>
                <div class="form-group" style="margin-left: 162px">
                    <div class="row">
                    <div class="name-date">
                        <p>
                            Entrusted to <span class="entrusted">{{ $dealer_name }}</span>
                            Due Date: <span class="date">{{ $date_ordered }}</span>
                        </p>
                    </div>
                    <div class="by">
                        <p>
                            By <span class="operator">{{ $prepared_by }}</span>
                        </p>
                    </div>
                    </div>
                </div>

            <div style="margin-left:40px">
                <div class="row"   >
                    <div class="col-md-2" > </div>
                    <div class="col-md-5" >
                        <table class="receipt-table-left">
                            <tr>
                                <th> QTY </th>
                                <th> Description </th>
                                <th> Unit Price </th>
                                <th> Amount </th>
                            </tr>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->item->name }}</td>
                                <td>{{ $order->item->price }}</td>
                                <td>{{ $order->quantity * $order->item->price }}</td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="payable float-right mr-2">
                                    <span>Total Php: {{ $amount }}</span><br>
                                    <span class="border-dark border-bottom" style="width: 120px">Discount: {{ $itemDiscount }}</span><br>
                                    <span>Net Payable: {{ ($amount - $itemDiscount) }}</span>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">

                            <div class="col-md-12">
                                <div style="float:left; margin-top:10px">
                                    <p></p>
                                    WITNESS
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div style="float:left; margin-top:10px">



                                    <div class="row">


                                        <div class="col-md-6">
                                            _________________

                                            <br>

                                            <em>Signature</em>

                                        </div>

                                        <div class="col-md-6">
                                            _________________

                                            <br>

                                            <em>Name (Printed)</em>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" >
                           <table   class="receipt-table-right"  >
                            <tr>
                                <th>
                                    <span >
                                        Recieved
                                    </span>

                                    <span style="margin-left:40px">
                                        Recieved
                                    </span>
                                </th>
                            </tr>

                            <tr>
                                <td>
                                    <div style="  ;text-align: left; padding:5px">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting   Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                        </p>



                                        <div style="text-align: center">

                                            <div style="form-group" style="margin-top:10px" >
                                                ________________________

                                                <br>

                                                <small>
                                                    ENTRUSTEE'S SIGNATURE
                                                </small>

                                            </div>

                                            <br>

                                            <div style="form-group" style="margin-top:10px" >
                                                <p>
                                                    <span class="entrustee-name">{{ $dealer_name }}</span>
                                                </p>

                                                <small>
                                                    ENTRUSTEE'S NAME (PRINTED)
                                                </small>
                                            </div>
                                        </div>

                                     </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-2" > </div>

                </div>
             </div>

            <div class="no-print" style="text-align: left; margin-top:100px; margin-bottom: 40px;">
                <button class="btn-info" id="print">Print </button>

                <a href="{{ url('/') }}">
                    <button class="btn-success">Home</button>
                </a>

            </div>
        </div>

        </div>

    </div>


  <body>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#print').click(function() {
                window.print();
            });
        });
    </script>
  </body>
</html>
