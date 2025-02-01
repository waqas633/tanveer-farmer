@extends('layout')
@section('container')
<div align="center">
<h1>Customer Summery</h1>
<p>Select Dates</p>
<form      onsubmit="return false">
	Enter Name: <input type="text" id="cname" name="">
	Start Date: <input type="date" id="date1" name="" value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data"  onclick="fetchstudent()">
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">No</th>
                <th width="100px">Name</th>
                <th width="80px">Type</th>
                              <th width="75px">Cash Received (CR)</th>
              <th width="75px">Cash Paid (DR)</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
    <span style="float: right; text-align: right;">
        
    <label style="font-size: 20px;">Cash Received:  </label><label id="tsr" style="font-size: 20px;">0</label><br>
    <label style="font-size: 20px;">Cash Payments:  </label><label id="tsp" style="font-size: 20px;">0</label><br>
<label style="font-size: 20px;">Closing Balance:  </label><label id="ts" style="font-size: 20px;">0</label></span>
</div>
</form>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
        	var cname=document.getElementById("cname").value;
        	var proname='';
            var url = "{{ url('customer-ledger') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date1:date1,
date2:date2,
proname:proname,
cname:cname,
                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response.pros2);
        console.log(response.dated2);
        
        $.each(response.dated2,function(key,item){
var dr=item.total_debit;
var cr=item.total_credit;
var att=cr-dr;
document.getElementById("ts").innerHTML=att;
document.getElementById("tsr").innerHTML=cr;
document.getElementById("tsp").innerHTML=dr;
        });
        $.each(response.pros2,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+cname+"</td><td>"+item.type+"</td><td>"+item.cr+"</td><td>"+item.dr+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
   $(function () {
              $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var route1 = "{{ url('autosale-customer') }}";
         $('#cname').typeahead({
            source: function (query, process) {
                return $.get(route1, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
     });


                    </script>
@endsection