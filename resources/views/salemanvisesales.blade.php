@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div align="center">
<h1>Cash Statment</h1>
<p>Select Dates</p>
<form      onsubmit="return false">
	Start Date: <input type="date" id="date1" name="" value="<?php echo date('Y-m-d'); ?>">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data"  onclick="fetchstudent()">

 <h4>Opening Balance:<label  id="ts">0</label></h4>
</div>
</form>
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="20%">Racevier</th>
                <th width="10%">Amount</th>
                <th width="20%">Payer</th>
                <th width="10%">Amount</th>
                <th width="40%">Discription</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
    <h4  align="center">Closing Balance:<label  id="cb">0</label></h4>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
        	var proname='';
            var url = "{{ url('cashbanktransection') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date1:date1,
date2:date2,
                },
    success:function(response){
     
          var ids=1;
          let cr=0;
          let dr=0;
        var bodyData = '';
        console.log(response);
        let totalDebit = parseInt(response.oldpre[0].total_debit) || 0;
let totalCredit = parseInt(response.oldpre[0].total_credit) || 0;
let resultopen = parseInt(response.opencr) - parseInt(response.opendr);
     document.getElementById("ts").innerHTML=resultopen;
        
        //document.getElementById("ts").innerHTML = parseInt(394700)+parseInt(response.oldpre[0].total_debit)-parseInt(response.oldpre[0].total_credit);
       //from transections
          $("#ttbody").html("");
          $.each(response.banks,function(key,item){
              console.log(item.id);
              if (item.type=="Banks") {
                  console.log(item.id);
                   bodyData+="<tr style='height:15px;'>"
                   bodyData += "<td>"+item.rbook.name+"</td>"
         + "<td>"+item.dr+"</td><td>"+item.pbook.name+"</td><td>"+item.cr+"</td><td>" + item.discription + "</td>";
  bodyData+="</tr>";
              cr+=parseFloat(item.cr);
              dr+=parseFloat(item.dr);
              }
              if (item.type=="CashRecovery" || item.type=="Expenses") {
                  
                  console.log(item.id);
                  if(item.cr==0){
                        bodyData+="<tr style='height:15px;'>"
                   bodyData += "<td></td><td></td><td>"+item.rbook.name+"</td>"
         + "<td>"+item.dr+"</td><td>" + item.discription + "</td>";
  bodyData+="</tr>";
  dr+=parseFloat(item.dr);
                   
                  }else if(item.dr==0){
                 
  
  
  bodyData+="<tr style='height:15px;'>"
                   bodyData += "<td>"+item.rbook.name+"</td><td>"+item.cr+"</td><td></td>"
         + "<td></td><td>" + item.discription + "</td>";
  bodyData+="</tr>";
  cr+=parseFloat(item.cr);
                  }
                  
              }
              
              
              
              
//             // bodyData+="<td>"+item.pbook.name+"</td><td>"+item.amount+"</td><td>"+item.rbook.name+"</td><td>"+item.amount+"</td><td>" + item.discription + "-" + (item.bank.name ?? 0) + "</td>";
//                  if (item.pid==7) {
//                       bodyData+="<tr style='height:15px;'>"
//                   bodyData += "<td>"+item.pbook.name+"</td><td>"+item.amount+"</td><td></td>"
//          + "<td></td><td>" + item.discription + "-" + (item.bank ? item.bank.name : 0) + "</td>";
//   bodyData+="</tr>";
//   cr+=parseFloat(item.amount);
//   console.log(item.pbook.name);
                     
//                  }else
//                  if (item.pid==3) {
//                       bodyData+="<tr style='height:15px;'>"
//                   bodyData += "<td></td><td></td><td>"+item.pbook.name+"</td><td>"+item.amount+"</td><td>" + item.discription + "-" + (item.bank ? item.bank.name : 0) + "</td>";
//   bodyData+="</tr>";
//   dr+=parseFloat(item.amount);
//   console.log(item.pbook.name);
                     
//                  }else
                 
                 
//                  if (item.pbook.name === "CASH IN HAND" || item.rbook.name === "CASH IN HAND") {
//                       if(item.genral_entries[0].dr==0){
//                       bodyData+="<tr style='height:15px;'>"
//                   bodyData += "<td></td><td></td><td>" + item.genral_entries[1].book.name + "</td>"
//          + "<td>" + item.genral_entries[1].dr + "</td><td>" + item.discription + "-" + (item.bank ? item.bank.name : 0) + "</td>";
//   bodyData+="</tr>";
//   dr+=parseFloat(item.amount);
//     console.log(item.pbook.name);
//                       }else 
//                       if(item.genral_entries[0].cr==0){
//                       bodyData+="<tr style='height:15px;'>"
//                   bodyData += "<td>"+item.genral_entries[1].book.name+"</td><td>"+item.genral_entries[1].cr+"</td><td></td>"
//          + "<td></td><td>" + item.discription + "-" + (item.bank ? item.bank.name : 0) + "</td>";
//   bodyData+="</tr>";
//   cr+=parseFloat(item.amount);
//     console.log(item.pbook.name);
//                       }
//                   }

//                  else {
//                       bodyData+="<tr style='height:15px;'>"
//                   bodyData += "<td>" + item.pbook.name + "</td><td>" + item.amount + "</td><td>" + item.rbook.name + "</td>"
//          + "<td>" + item.amount + "</td><td>" + item.discription + "-" + (item.bank ? item.bank.name : 0) + "</td>";
//   bodyData+="</tr>";
//   cr+=parseFloat(item.amount);
//   dr+=parseFloat(item.amount);
//                   }
                  
        })
       
        bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td></td><td>"+cr+"</td><td></td><td>"+dr+"</td><td></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    
        
        $("#ttbody").append(bodyData);
        document.getElementById("cb").innerHTML = resultopen+cr-dr;
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