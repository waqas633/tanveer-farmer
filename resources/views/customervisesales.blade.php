@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div align="center">
<p>Select Dates</p>
<form      onsubmit="return false">
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data"  onclick="fetchstudent()">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="3%">ID</th>
            <th width="12%">Date</th>
            <th  width="15%">VAN</th>
            <th  width="5%">Weight</th>
            <th  width="17%">Former</th>
            <th  width="5%">Rate</th>
            <th  width="10%">Amount</th>
            <th  width="10%">Opening</th>
            <th  width="10%">Receiving</th>
            <th  width="5%">Balance</th>
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
            var url = "{{ url('date-vise-localsale') }}";
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
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
var total_weight=0;
var total_price=0;
        $.each(response.var,function(key,item){
            $("#ttbody").html(""); 
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.rbook.name+"</td><td>"+item.weight+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.Open+"</td><td>"+item.recivings+"</td><td>"+item.Close+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    table_weight=table_weight+parseFloat(item.weight);
                    // table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.recivings);
        })
        $.each(response.var1,function(key,item){
total_weight=total_weight+parseFloat(item.tweight);
total_price=total_price+parseFloat(item.tprice);
        });
        var netLoss=parseFloat(total_weight)-parseFloat(table_weight);
        var netlossamount=parseFloat(total_price)-parseFloat(table_purchaser_amount);
        bodyData+="<tr>"
        bodyData+="<td></td><td></td><td><b>Total</b></td><td><b>"+table_weight+"</b></td><td></td><td></td><td><b>"+table_purchaser_amount+"</b></td><td><b>"+table_profit_amount+"</b></td><td></td><td></td>";
        bodyData+="</tr>";
            bodyData+="<tr>";
        bodyData+="<td></td><td></td><td><b>Total Weight</b></td><td><b>"+total_weight+"</b></td><td><b>Sold Weight</b></td><td><b>"+table_weight+"</td><td><b>Net Loss</b></td><td><b>"+netLoss+"</b></td><td></td><td></td>";
        bodyData+="</tr>";
        bodyData+="<tr>";
        bodyData+="<td></td><td></td><td><b>Total Price</b></td><td><b>"+total_price+"</b></td><td><b>Sold Price</b></td><td><b>"+table_purchaser_amount+"</b></td><td><b>Net Loss</b></td><td><b>"+netlossamount+"</b></td><td></td><td></td>";
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