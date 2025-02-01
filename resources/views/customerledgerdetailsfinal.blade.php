@extends('layout')
@section('container')

<div align="center">
<h1>Customer Due's Ledger</h1>

<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">Cust Id</th>
                <th width="100px">Name</th>
                    <th width="75px">Cash Paid (DR)</th>
                              <th width="75px">Cash Received (CR)</th>
          
              <th width="80px">Closing</th>
              
            </tr>
        </thead>
        <tbody id="ttbody">
            @foreach($dated2 as $a)
            <tr>
                
                <th width="75px">{{$a->book['id']}}</th>
                <th width="100px">{{$a->book['name']}}</th>
                <th width="75px">{{$a->dr}}</th>
                              <th width="75px">{{$a->cr}}</th>
              
              <th width="80px">{{$a->dr-$a->cr}}</th>
            </tr>
            @endforeach
            <tr>
                @foreach($dated1 as $b)
                <th colspan="2">Total</th>
                <th width="75px">{{$b->dr}}</th>
                              <th width="75px">{{$b->cr}}</th>
              
              <th width="80px">{{$b->dr-$b->cr}}</th>
              @endforeach
            </tr>
        </tbody>
    </table>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
            var url = "{{ url('public-ledger') }}";
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
        var bodyData = '';
        console.log(response.pros2);
        console.log(response.dated2);
        
        $.each(response.pros2,function(key,item){
var dr=item.dr;
var cr=item.cr;
var att=cr-dr;
document.getElementById("ts").innerHTML=att;
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


                    </script>
@endsection