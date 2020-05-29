
@extends('layouts.app')

@section('content')
<!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Forms       </li>
          </ul>
        </div>
      </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
              <h1 class="h3 display">Items</h1> 
              <form method="GET">
                  <div class="row">
                      <div class="col-md-6"> 
                           <div class="form-group">
                            <select name="category" class="form-control">
                              <option>All categories</option>
                              <option>Natasha</option>
                              <option>MSE</option> 
                              <option>Avon</option>
                              <option>Tupperware</option>
                              <option>Personal Collection</option>
                              <option>Beautiful Horizon</option> 
                            </select>  
                          </div>
                      </div>      
                      
                      <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" name="search" placeholder="Search" class="pull-right form-control"> 
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
                          <th>#</th>
                          <th>Photo</th>
                          <th>Description</th>
                          <th>Category</th> 
                          <th>Price</th>
                          <th>Available</th>
                          <th>Quantity</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>  
                        <tr>
                          <th scope="row">1</th>
                          <td> 
                             <img src="img/avatar-7.jpg" alt="person" class="" style="width: 50px"  > 
                          </td>
                          <td>
                              <p>
                                This is the dummy information of this items.                               
                                This is the dummy information of this items. 
                              </p>
                            </td>
                            <td> 
                                <span>
                                   MSE
                               </span>
                            </td>  <td> 
                                <span>
                                   php 100.00
                               </span>
                            </td>  
                          <td> 
                              <p>
                                  10
                              </p>
                          </td>  
                            <td> 
                              <input type="number" class="form-control" value="1">  
                          </td>
                          <td>  
                              <button type="submit" class="btn btn-success" > Add </button>
                              
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                    <div class="form-group"  style="margin-top:10px" >    
                        <nav aria-label="...">
                          <ul class="pagination">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                              <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#">Next</a>
                            </li>
                          </ul>
                        </nav> 
                    </div>
                </div>
              </div>
            </div> 
          </div>
            
            
            
            
            
         <div class="row">
             <div class="col-lg-12" >
                   <header> 
                      <h1 class="h3 display">Order Details</h1> 
                      <div>
                          <span>
                            <b>Name</b>: Jesus Erwin Suarez  
                          </span>
                          
                          <br>
                          
                          <span>
                            <b>Credit Limit</b>: Php 2,000
                          </span>
                          
                          <br> <br>
                          
                          <span>
                            <b>Payable</b>: Php 1,000.00
                          </span>
                          <br>
                          <span>
                            <b>Balance</b>: Php 1,000.00
                          </span>
                          
                          
                      </div> 
                  </header> 
             </div>
              
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Cart</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Price</th> 
                          <th>Quantity</th>
                          <th>Subtatotal</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>  
                        <tr>
                          <th scope="row">1</th>
                          <td> 
                             <img src="img/avatar-7.jpg" alt="person" class="" style="width: 50px"  > 
                          </td> 
                            <td>
                              <b>
                                   Natashia
                              </b>
                            </td> 
                            <td>
                                <p>
                                    This is the dummy information of this items.                               
                                    This is the dummy information of this items. 
                                </p>
                            </td>  
                            <td>  
                                <span>
                                    Php 2,000.00   
                                </span>
                            </td>   
                            <td> 
                               2 
                          </td>
                            <td> 
                               php 4,000 
                          </td>
                          <td>  
                              <button type="submit" class="btn btn-danger" > Remove </button> 
                          </td>
                        </tr> 
                          
                         
                          <!-- Total -->
                         <tr>
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                                
                                <td>  </td>
                                <td>  </td>
                                <td>  </td>
                               
                                <td>
                                    <b>Total</b> 
                                    <br> 
                                    <span></span>4,000
                             
                             </td>
                                <td>  </td>
                          </tr>
                      </tbody>
                    </table>  
                    <hr>  
                  </div> 
                    <div class="form-group" style="margin-top:10px">
                        <a href="order-step-3.html">
                            <button type="submit" class="btn btn-info" > Proceed </button>     
                        </a>        
                    </div>  
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