@extends('layout')
@section('container')
<div class="row">
    
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-12">

                            <div class="card-box noradius noborder bg-dark">
                               
                                <h6 class="m-b-20 text-white counter">
<i class="fa fa-home" style="font-size:30px; margin-top:-40px;"></i>
<label style="font-size: 20px;">Welcome</label>
<label id="ltr" style="font-size: 20px;">{{session('firm_name')}}</label>

                                    <label style="font-size: 20px; margin-left:20px;"><?php echo date('Y-m-d'); ?></label>
                                    
                                     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  
<label id="runningTime1" style="font-size: 20px; margin-left: 10px; margin-top: -5px;" ></label>
<script type="text/javascript">
$(document).ready(function() {
 setInterval(runningTime1, 1000);
});
function runningTime1() {
  $.ajax({
    url: 'timeScript.php',
    success: function(data) {
       $('#runningTime1').html(data);
     },
  });
}
</script>
                                </h6>
                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                            <a href="/customer">
                            <div class="card-box noradius noborder bg-lime-green">
                                <i class="fa fa-user-plus float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Add New Account</h5>
                                <h5 class="m-b-20 text-white counter" id="h1_s">0</h5>
                                <span class="text-white">12 Today</span>
                            </div>
                            </a>
                        </div>
    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                              <a href="/sales">
                            <div class="card-box noradius noborder bg-purple">
                                <i class="fa fa-download float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Whole Sale</h5>
                                <h5 class="m-b-20 text-white counter"  id="h1_p">0</h5>
                                <span class="text-white">12 Today</span>
                            </div>
                            </a>
                        </div>
                        

                    
                         <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                               <a href="/recoverys">
                            <div class="card-box noradius noborder bg-blue">
                                <i class="fa fa-sign-out  fa-rotate-90 float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Recoveries</h5>
                                <h5 class="m-b-20 text-white counter"  id="h1_pr">0</h5>
                                <span class="text-white">12 Today</span>
                            </div>
                              </a>
                        </div>

                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
                              <a href="/cashRecovery">
                            <div class="card-box noradius noborder bg-danger">
                                <i class="fa fa-shopping-cart float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-18">Expenses</h5>
                                <h5 class="m-b-20 text-white counter"  id="h1_r">0</h5>
                                <span class="text-white">25 Today</span>
                            </div>
                            </a>
                        </div>

                     
 <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
       <a href="/reportTabs">
                            <div class="card-box noradius noborder bg-info">
                                <i class="fa fa-envelope float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Reports</h5>
                                <h5 class="m-b-20 text-white counter"  id="h1_slry">0</h5>
                                <span class="text-white">5 New</span>
                            </div>
                            </a>
                        </div>

 <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
       <a href="/createuser">
                            <div class="card-box noradius noborder bg-lime-green">
                                <i class="fa fa-user-circle-o float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Control Panel</h5>
                                <h5 class="m-b-20 text-white counter"  id="usr">0</h5>
                                <span class="text-white">5 New</span>
                            </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4">
       <a href="/customerledgerdetails">
                            <div class="card-box noradius noborder bg-info">
                                <i class="fa fa-envelope float-right text-white"></i>
                                <h5 class="text-white text-uppercase m-b-20">Messages</h5>
                                <h5 class="m-b-20 text-white counter"  id="h1_slry">0</h5>
                                <span class="text-white">5 New</span>
                            </div>
                            </a>
                        </div>





                    </div>
                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
         
         
     
      fetchstudent();
        function fetchstudent(){
            var url = "{{ url('fetch-deshboard') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                },
    success:function(response){
   
        console.log(response.pros);
        document.getElementById("h1_s").innerHTML = response.sal;
        document.getElementById("h1_sr").innerHTML = response.salr;
        document.getElementById("h1_p").innerHTML = response.pru;
        document.getElementById("h1_pr").innerHTML = response.prur;
        document.getElementById("h1_r").innerHTML = response.rec;
        document.getElementById("h1_py").innerHTML = response.pay;
        document.getElementById("h1_slry").innerHTML = response.slr;
        document.getElementById("usr").innerHTML = response.usr;
        document.getElementById("ltr").innerHTML = response.ltrhd;
    }

});
        }
   


                    </script>

@endsection