@php
 if(!session()->has('user')){
       header("Location: /");
die();
    }
@endphp
<!DOCTYPE html>
<head>
    <title>Bhagtanwala Poltry Solution</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
   <!-- For corser -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
       

    <!-- Bootstrap CSS -->
    <link href="/files/bootstrap.min.css" rel="stylesheet" type="text/css">
     <link href="/files/bootstrap1.min.css" rel="stylesheet" type="text/css">

   

    <!-- Custom CSS -->
    <link href="/files/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/files/Chart.min.css">
    <link rel="stylesheet" type="text/css" href="/files/datatables.min.css">
    
    
        <style>
          .readonly-input {
            margin-left: 10px;
            border: none;
            background-color: transparent;
            font-size: 16px;
            font-weight: bold;
            pointer-events: none; /* Makes it unselectable */
        }
        .focused {
            background-color: #d3d3d3;
        }
   
        
        .highlight {
            background-color: yellow !important;
        }
        /* Basic styles for tab buttons */
.tabs {
    display: flex;
    cursor: pointer;
}

.tab-button {
    padding: 10px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    margin-right: 2px;
}

.tab-button:hover {
    background-color: #ddd;
}

/* Hidden tab content by default */
.tab-content {
    display: none;
    padding: 20px;
    border: 1px solid #ccc;
    border-top: none;
}

/* Active tab content */
.tab-content.active {
    display: block;
}

        
* {
  box-sizing: border-box;
}


/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}
/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<script>
function unpassword(){
   sessionStorage.setItem('first', null); 
   const usersave = JSON.parse(sessionStorage.getItem('first'));
       // alert(usersave);
       console.log(usersave);
}
    function password(){
        const usersave = JSON.parse(sessionStorage.getItem('first'));
       // alert(usersave);
       console.log(usersave);
        let person = prompt("Please Enter Password", ""+usersave);
        if(usersave==null){
  if (person != "base64") {
    alert("Enter Correct Password");
    //sessionStorage.setItem('first', person);
     location.reload();
     
    //document.getElementById("demo").innerHTML =
   // "Hello " + person + "! How are you today?";
  }
  else{
      sessionStorage.setItem('first', person);
      
  }
        }
    }
</script>

</head>

<body>
@section('header')
    <div id="main" class="">

        <!-- top bar navigation -->
        <div class="headerbar">

            <!-- LOGO -->
            <div class="headerbar-left">
                <a href="/welcome" class="logo">
                    <img alt="Logo" src="/files/logo.png">
                    <span>Bhagtanwala Poltry Solution</span>
                </a>
            </div>

            <nav class="navbar-custom">



                     

                

                            
               <ul class="list-inline float-right mb-0">
               <li class="list-inline-item dropdown notif">
                        <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="false">
                            <img src="/files/admin.png" alt="Profile image" class="avatar-rounded">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <i class="fa fa-user-circle-o" style="margin-left:5px;"></i>
                                
                                    <span>Hello, {{session('user')}}</span>
                               
                            </div>

                            <!-- item-->
                            <a href="/updateuser" class="dropdown-item notify-item">
                                <i class="fa fa-user"></i>
                                <span>Profile</span>
                            </a>
                             <!-- item-->
                             @if(session('user')=='admin')
                            <a href="/createuser" class="dropdown-item notify-item">
                                <i class="fa fa-users"></i>
                                <span>User Manager</span>
                            </a>
@endif
                            <!-- item-->
                            <a href="/logout" class="dropdown-item notify-item">
                                <i class="fa fa-sign-out  fa-2x"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                    </ul>     

             

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left">
                            <i class="fa fa-bars"></i>
                        </button>
                    </li>
                </ul>

            </nav>

        </div>
        @show
        <!-- End Navigation -->






@section('sidebar')

        <!-- Left Sidebar -->
        <div class="left main-sidebar">

            <div class="sidebar-inner leftscroll">

                <div id="sidebar-menu">

                    <ul>
                        <li class="submenu">
                            <a href="/welcome">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span> Dash Board </span>
                            </a>
                        </li>

                        <li class="submenu"  onclick="unpassword()">
                            <a id="tables" href="#">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                <span> Sales </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                             
                          
                                <li>

                                    <a href="sales"><i class="fa fa-plus-square" aria-hidden="true"></i>Whole Sales</a>
                                </li>
                                <li>

                                    <a href="localsales"><i class="fa fa-plus-square" aria-hidden="true"></i>Local Sales</a>
                                </li>
                                <li>
                                   <a href="/productvisesales"><i class="fa fa-search" aria-hidden="true"></i>Date Vise Whole Sale</a>
                               </li>
                               <li>
                                  <a href="/customervisesales"><i class="fa fa-search" aria-hidden="true"></i>Date Vise Local Sales</a>
                              </li>
                              <li>
                                <a href="/localsalessummary"><i class="fa fa-search" aria-hidden="true"></i>Local Sales Summary</a>
                            </li>
                              <li>
                                <a href="/wholesalesSummary"><i class="fa fa-search" aria-hidden="true"></i>WS Summery</a>
                            </li>
                            <li>
                                <a href="/wholesalesMonthlySummary"><i class="fa fa-search" aria-hidden="true"></i>WS Monthly Summery</a>
                            </li>
                              <li>
                                <a href="/wholesalesdetailsViseSummary"><i class="fa fa-search" aria-hidden="true"></i>WS Detailed Summery</a>
                            </li>

                                <li>

                                    <a href="bill"><i class="fa fa-search" aria-hidden="true"></i>Search Invoice</a>
                                </li>
                               
                                  <li>
                                    <a href="/salemanvisesales"><i class="fa fa-search" aria-hidden="true"></i>Sale Man Vise</a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="submenu"  onclick="unpassword()">
                            <a href="#">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                <span> Purchases </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="/purchases"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Purchases</a>
                                </li>
                                <li>
                                    <a href="/billpurchase"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Purchase Invoices</a>
                                </li>
                                <li>
                                    <a href="/datevisepurchases"><i class="fa fa-search" aria-hidden="true"></i>Daily Purchases</a>
                                </li>
                                <li>
                                    <a href="/customervisepurchases"><i class="fa fa-user-o" aria-hidden="true"></i>Distributer Vise</a>
                                </li>
                                <li>
                                    <a href="/productvisepurchases"><i class="fa fa-search" aria-hidden="true"></i>Product Vise</a>
                                </li>
                                
                            </ul>
                        </li> --}}

                        {{-- <li class="submenu"  onclick="unpassword()">
                            <a href="#">
                                <i class="fa fa-wpforms"></i>
                                <span> Payments </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="/payments"><i class="fa fa-wpforms"></i>Payments</a>
                                </li>
                                
                                 
                                <li>
                                    <a href="/datevisepayments"><i class="fa fa-search"></i>Daily Payments</a>
                                </li>
                                <li>
                                    <a href="/customervisepayments"><i class="fa fa-user-o"></i>Customer Vise</a>
                                </li>
                              
                                
                            </ul>
                        </li> --}}

                        <li class="submenu"  onclick="unpassword()">
                            <a href="#">
                                <i class="fa fa-cc-visa" aria-hidden="true"></i>
                                <span> Payments </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="/recoverys">
                                        <i class="fa fa-cc-visa" aria-hidden="true"></i>Bank Recoveries </a>
                                </li>
                                <li>
                                    <a href="/cashRecovery">
                                        <i class="fa fa-cc-visa" aria-hidden="true"></i>Cash Recoveries </a>
                                </li>
                                  <li>
                                    <a href="/expenses"><i class="fa fa-wpforms"></i>Expenses</a>
                                </li>
                                 <li>
                                    <a href="/expensehead"><i class="fa fa-users"></i>Expense Heads</a>
                                </li>
                                <li>
                                    <a href="/dateviserecovery"><i class="fa fa-search"></i>Date Vise Recovery</a>
                                </li>
                               <li>
                                    <a href="/customerviserecovery"><i class="fa fa-user-o"></i>Customer Vise</a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="submenu"  onclick="unpassword()">
                            <a href="#">
                                <i class="fa fa-clone" aria-hidden="true"></i>
                                <span> Products </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                 <li>
                                    <a href="/stockview"><i class="fa fa-file" aria-hidden="true"></i>Stock Report</a>
                                </li>
                               
                                <li>
                                    <a href="/brand"><i class="fa fa-plus-square" aria-hidden="true"></i>Add Brand</a>
                                </li>
                                <li>
                                    <a href="/items"><i class="fa fa-plus-square" aria-hidden="true"></i>Add Product</a>
                                </li>
                                <li>
                                    <a href="/itemupdates"><i class="fa fa-cog   fa-spin" aria-hidden="true"></i>Manage Product</a>
                                </li>
                                 <li>
                                    <a href="/productDiscount"><i class="fa fa-stop-circle-o" aria-hidden="true"></i>Add Discount</a>
                                </li>
                                  
                                
                            </ul>
                        </li> --}}

                        <li class="submenu" onclick="unpassword()">
                            <a href="#">
                                 <i class="fa fa-users" aria-hidden="true"></i>
                                <span> Customers </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="/public-ledger-details"><i class="fa fa-address-book" aria-hidden="true"></i>Customer Ledger Summary</a>
                                </li> 
                                <li>
                                    <a href="/customerledgerdetails"><i class="fa fa-address-book" aria-hidden="true"></i>Customer Ledger</a>
                                </li>
                                {{-- <li>
                                    <a href="/public-ledger"><i class="fa fa-address-book" aria-hidden="true"></i>Customer Due's</a>
                                </li>
                                 <li>
                                    <a href="/town"><i class="fa fa-map-marker" aria-hidden="true"></i>Add Town</a>
                                </li> --}}
                                <li>
                                    <a href="/customer"><i class="fa fa-medkit" aria-hidden="true"></i>Add Account</a>
                                </li>
                                {{-- <li>
                                    <a href="/updatecustomer"><i class="fa fa-cog   fa-spin" aria-hidden="true"></i>Manage Customer</a>
                                </li> --}}
                                <li>
                                    <a href="/customerledger"><i class="fa fa-id-badge" aria-hidden="true"></i>Customer Summery</a>
                                </li>
                               
                              
                            </ul>
                        </li>
<li class="submenu" onclick="password()">
                            <a href="#">
                                 <i class="fa fa-building" aria-hidden="true"></i>
                                <span> Company </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                
                                 <li>
                                    <a href="/balancesheet"><i class="fa fa-address-book" aria-hidden="true"></i>Smart Balance Sheet</a>
                                </li>
                                 <li>
                                    <a href="/profitfinal"><i class="fa fa-address-book" aria-hidden="true"></i>Profit Statment</a>
                                </li>
                                <li>
                                    <a href="/dailycash"><i class="fa fa-address-book" aria-hidden="true"></i>Cash Statment</a>
                                </li>
                                 <li>
                                    <a href="/datevisesales"><i class="fa fa-money" aria-hidden="true"></i>Date Vise</a>
                                </li>
                              
                                
                                 <li>
                                    <a href="/dateviseexpenses"><i class="fa fa-search"></i>Daily Expenses</a>
                                </li>
                                 <li>
                                    <a href="/company"><i class="fa fa-user" aria-hidden="true"></i>Add Company</a>
                                </li>
                                <li>
                                    <a href="/cogroup"><i class="fa fa-user" aria-hidden="true"></i>Add Group</a>
                                </li>
                                <li>
                                    <a href="/employees"><i class="fa fa-user" aria-hidden="true"></i>Add Employee</a>
                                </li>
                            </ul>
                        </li>
                       <li class="submenu"  onclick="unpassword()">
                            <a href="#">
                                 <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span> Employees </span>
                                <span style="float:right;"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                            </a>
                            <ul class="list-unstyled">
                                 <li>
                                    <a href="/bookers"><i class="fa fa-user" aria-hidden="true"></i>Add Staff</a>
                                </li>
                                <li>
                                    <a href="/fetchstartsalary"><i class="fa fa-id-badge" aria-hidden="true"></i>Pay Salary</a>
                                </li>
                            </ul>
                        </li>

                        

                    </ul>

                    <div class="clearfix"></div>

                </div>

                <div class="clearfix"></div>

            </div>

        </div>
        @show
        <!-- End Sidebar -->






        <div class="content-page" style="background-color:white;">

            <!-- Start content -->
            <div class="content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="breadcrumb-holder">
                                <h1 class="main-title float-left" id="aes">
                                    @php
                                    $hour = date('H', time());

if( $hour > 6 && $hour <= 11) {
  echo '<i class="fa fa-coffee fa-1x">   </i>'."   Good Morning";
}
else if($hour > 11 && $hour <= 16) {
  echo '<i class="fa fa-sun fa-1x">   </i>'."   Good Afternoon";
}
else if($hour > 16 && $hour <= 23) {
  echo '<i class="fa fa-moon-o fa-1x">   </i>'."   Good Evening";
}
else {
  echo '<i class="fa fa-cloud fa-1x">   </i>'."   Why aren't you asleep?";
}
                                    @endphp




                                </h1>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  
<i class="fa fa-clock-o fa-2x" style="margin-left: 30px;"></i><label id="runningTime" style="font-size: 20px; margin-left: 10px; margin-top: -5px;" ></label>
<script type="text/javascript">
$(document).ready(function() {
 setInterval(runningTime, 1000);
});
function runningTime() {
  $.ajax({
    url: 'timeScript.php',
    success: function(data) {
       $('#runningTime').html(data);
     },
  });
}
</script>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item" style="text-transform: uppercase; font-size:20px;">{{session('user')}}</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                            

                        </div>
                    </div>
                    <!-- end row -->


                    
 <!-- all data is here -->                       

                       
@section('container')
@show
                       
                    
                 

                </div>
                <!-- END container-fluid -->

            </div>
            <!-- END content -->
  <footer class="footer">
            <span class="text-right">                
                Copyright <a target="_blank" href="https://www.facebook.com/Softex-Pakistan-1072012249578630">Softex Pakistan</a>
            </span>
            <span class="float-right">
                <!-- Copyright footer link MUST remain intact if you download free version. -->
                <!-- You can delete the links only if you purchased the pro or extended version. -->
                <!-- Purchase the pro or extended version with PHP version of this template: https://bootstrap24.com/template/nura-admin-4-free-bootstrap-admin-template -->
                Powered by <a target="_blank" href="https://www.facebook.com/Softex-Pakistan-1072012249578630" title="Best Solution For Pharmacy"><b>Softex Pakistan</b></a>
            </span>
        </footer>
        </div>
        

        
        <script src="/files/jquery.min.js.download"></script>
       
     

        <!-- App js -->
        <script src="/files/admin.js.download"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    </div>

        <script src="/files/popper.min.js.download"></script>
        <script src="/files/bootstrap.min.js.download"></script>


        <!-- App js -->

    



</body></html>