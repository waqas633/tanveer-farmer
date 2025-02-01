@extends('layout')
@section('container')
@php
$balancezz=0;
$balancenet=0;
$exp=0;
foreach($expenses as $ex){
$exp+=$ex->amount;
}
foreach($cashes as $a){
$balancezz+=$a->balance;
}
$balancenet=$balancezz;
foreach($dues as $a){
$balancenet=$balancenet+$a->dr-$a->cr;
}
$balancenet=$balancenet+$price;

@endphp
<script>
    
        const usersave = JSON.parse(sessionStorage.getItem('first'));
       // alert(usersave);
       console.log(usersave);
        
        if(usersave==null){
            let person = prompt("Please Enter Password", ""+usersave);
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
    
</script>
<div align="center">
<h1>Balance Sheet</h1>
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Liabilities</th>
              <th>Assets</th>
            </tr>
        </thead>
        
        <tbody id="ttbody">
            <tr>
                <td>
                   <table style="width: 100%;">
                        <tr>
                            <th>Liabilities</th>
                            <th></th>
                            <th>Rs</th>
                        </tr>
                        
                        <tr>
                           <td><b>Payments</b></td>
                           
                           <td></td>
                <td>0</td> 
                        </tr>
                        @foreach($expenses as $a)
                        <tr>
                            <td>
                       
                            {{$a->expenseHead->name}}
                            
                            </td>
                            <td>{{$a->amount}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td><b>Total Of Expenses</b></td>
                            <td></td>
                            <td>{{$exp}}</td>
                        </tr>
                        
                    </table> 
                </td>
                <td>
                    <table style="width: 100%">
                        <tr>
                            <th>Assets</th>
                            <th></th>
                            <th>Rs</th>
                        </tr>
                        <tr>
                           <td><b>Dues</b></td>
                           <td></td>
                        @foreach($dues as $a)   
                <td>{{round($a->dr-$a->cr,2)}}</td> 
                @endforeach
                        </tr>
                        <tr>
                           <td><b>Stock In Hand</b></td>
                           <td></td>
                <td>{{round($price,2)}}</td> 
                        </tr>
                       
                         
                        @foreach($cashes as $a)
                        @if ($a->bank_type == 1)
                         <tr>
                           <td><b>Cash In Hand</b></td>
                           <td>{{ $a->balance }}</td>
                <td></td> 
                        </tr>
                        @endif
                        @if ($a->bank_type == 2)
                        <tr>
                           <td><b>Cash at Bank</b></td>
                           <td>{{ $a->balance }}</td>
                <td></td> 
                        </tr>
                        @endif
                       
                        @endforeach
                         <tr>
                           <td><b>Total</b></td>
                           <td></td>
                <td>{{$balancezz}}</td> 
                        </tr>
                        <tr>
                            <td>
                                <b>Net Balance</b>
                            </td>
                            <td>
                                
                            </td>
                            <td>
                                {{$balancenet}}
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
            </table>
            
            
            
         
    <span style="float: right; text-align: right;">
</div>
</form>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                    function fetchprint(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
        	var cname=document.getElementById("cname").value;
        	alert(cname);
        	var proname='';
var url = "{{ url('customer-ledger-print?date1=') }}" + date1 + "&date2=" + date2 + "&proname=" + proname + "&cname=" + cname;

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
    }});
window.open(url,'_blank');


        }
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
        	var cname=document.getElementById("cname").value;
        	var proname='';
            var url = "{{ url('customer-ledger1') }}";
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
        console.log(response.sales);
        
        $.each(response.pros2,function(key,item){
var dr=item.dr;
var cr=item.cr;
var att=cr-dr;
document.getElementById("ts").innerHTML=Math.round(att * 100) / 100;
document.getElementById("tsr").innerHTML=cr;
document.getElementById("tsp").innerHTML=dr;
        });
        
        $.each(response.dated2,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+cname+"</td><td>"+item.type+"</td><td>"+item.cr+"</td><td>"+item.dr+"</td>";
                    
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