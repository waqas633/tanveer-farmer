@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div align="center">
<h2>Local Sales Summary</h2>
<form      onsubmit="return false">
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data"  onclick="fetchstudent()">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="3%">ID</th>
            <th width="12%">Date</th>
            <th  width="5%">Weight</th>
            <th  width="17%">Sale Amount</th>
            <th  width="5%">Profit</th>
            <th  width="10%">Purchase weight</th>
            <th  width="10%">Purchase Price</th>
            <th  width="10%">Weight Loss</th>
            <th  width="5%">WB Profit</th>
        </tr>
    </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
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
        	// var cname=document.getElementById("cname").value;
        	var proname='';
            var url = "{{ url('date-vise-localsale-summary') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        startDate:date1,
        endDate:date2,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        var bodyData1 = '';
var table_weight=0;
var purchase=0;
var total_profit=0;
var total_weight=0;
var total_price=0;
var lossprice=0;
var netweightloss=0;
        $.each(response.var,function(key,item){
            $("#ttbody").html(""); 
     bodyData+="<tr>"
            netweightloss=parseFloat(item.tweight)-parseFloat(item.total_weight);
lossprice=parseFloat(item.profit)-parseFloat(item.purchase);
table_weight=table_weight+parseFloat(item.total_weight);
purchase=purchase+parseFloat(item.purchase);
total_profit=total_profit+parseFloat(item.profit);
total_weight=total_weight+parseFloat(item.tweight);
total_price=total_price+parseFloat(item.tprice);

                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.total_weight+"</td><td>"+item.purchase+"</td><td>"+item.profit+"</td><td>"+item.tweight+"</td><td>"+item.tprice+"</td><td>"+netweightloss+"</td><td>"+lossprice+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        var netLoss=parseFloat(total_weight)-parseFloat(table_weight);
        var netlossamount=parseFloat(purchase)-parseFloat(total_price);
        bodyData+="<tr>"
            bodyData+="<td colspan='2'><b>Totals</b></td><td>"+total_weight+"</td><td>"+purchase+"</td><td>"+total_profit+"</td><td>"+total_weight+"</td><td>"+total_price+"</td><td>"+netLoss+"</td><td>"+netlossamount+"</td>";
            bodyData+="</tr>";
        var sa=0;
        var dis=0;
        console.log(response.sbook);
        console.log(total_weight);
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