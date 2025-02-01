@extends('layout')
@section('container')
    
<h1>Bill Recoveries</h1>
<form  method="get" action="/salrecovery">
<div class="row">

<div class="col-sm-2">                
Select Date For Recovery </div><div class="col-sm-4"><input type="Date" class="form-control" name="date"></div></div>

<table class="table table-bordered table-striped">
        <thead>
            
            <tr>
                <th width="75px">No</th>
                <th>Party</th>
                <th  width="180px">Date & Time</th>
                <th width="150px">Amount</th>
                <th width="75px">Discount</th>
                <th  width="150px">Net Price</th>
                <th width="75px"  id="checkboxlist">Select</th>
            </tr>
            </thead>
        <tbody>
            @foreach($dalysales as $a)
         
         <tr>
             <td>{{$loop->iteration}}</td>
                     @foreach($a->book as $b)
                     <td>{{$b->name}}</td>
                     @endforeach
                     <td>{{$a->date}}  {{$a->time}}</td>
                     <td>{{$a->sale}}</td>
                     <td>{{$a->discount}}</td>
                     <td>{{$a->balnce}}</td>
                     <td><input type="checkbox" name="coi[]" value={{$a->id}}></td>
                 
           </tr>    
          
                     @endforeach
        
        </tbody>
    </table>
    <span style="float:right;"><input type="submit" value="Recover All" class="btn btn-success"></span>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script type="text/javascript">
  	
 $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      var route = "{{ url('autorecovry-now') }}";
             $('#payname').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
             $("#subs").click(function(e){
  e.preventDefault();

        var pid = $("input[name=pid]").val();
        var pname = $("input[name=payname]").val();
        var pdetails = $("input[name=paydetails]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('recovery_single') }}";
        
        $.ajax({
           url:url,
           method:'GET',
           data:{
                pid:pid,
                  pname:pname,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
                },
           success:function(response){
               
              if(response.success){
              
                 alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
    fetchpayments();    
    });
    fetchpayments();
        function fetchpayments(){
            var url = "{{ url('fetch-recory') }}";
            var pdate = $("input[name=pdate]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:pdate,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        
        console.log(response.pros);
        document.getElementById("pid").value = response.sid;
        document.getElementById("lpay").value = response.pros;
        $("tot").append(response.pros);
        $("tbody").html("");
        var sa=0;
        var dis=0;
        $.each(response.sbook,function(key,item){
            $("#ttbody2").html(""); 
            sa=sa+parseFloat(item.sale);
            dis=dis+parseFloat(item.discount);
     bodyData1+="<tr>"
                    bodyData1+="<td>"+ids+"</td><td>"+item.book.name+"</td><td>"+item.date+"  "+item.time+"</td><td>"+item.sale+"</td><td>"+item.discount+"</td><td>"+(item.sale-item.discount)+"</td>";
                    
                    bodyData1+="</tr>";
                    ids=ids+1;
        }

        )
        bodyData1+="<tr>"
                    bodyData1+="<td></td><td>Total</td><td></td><td>"+sa.toFixed(2)+"</td><td>"+dis.toFixed(2)+"</td><td>"+(sa-dis).toFixed(2)+"</td>";
                    
                    bodyData1+="</tr>";
        $("#ttbody2").append(bodyData1);
    }

});
        
     
    };


  </script>
@endsection