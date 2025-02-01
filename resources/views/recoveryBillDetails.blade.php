@extends('layout')
@section('container')
@php
$bid=0;
foreach($sid as $c)
{
$bid=$c->id;
}

@endphp
<div class="container">
<h1>Cash Recoveries</h1>
<div class="col-md-4">
<form   onsubmit="return false">
<div>
    @foreach($sid as $b)
    <label style="width:120px;float:left; height: 20px;">ID</label><input type="text" id="pid" name="pid" style="width: 170px;" readonly></div>
    <div style="margin-top:10px;">	
    <label  style="width:120px;float:left;">Date</label><input type="date" id="pdate" name="pdate" style="width: 170px; value="<?php echo date('Y-m-d'); ?>"></div>
	@foreach($b->book as $c)
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Name</label>
    <input type="text" name="payname" id="payname" value="{{$c->name}}">
	@endforeach</div>
    <div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Details</label><input type="text" id="paydetails" name="paydetails" value="Cash Received against invoice No {{$b->id}}"></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Amount</label><input type="text" id="payamount" name="payamount" value="{{$b->sale-$b->purchase-$b->discount}}"></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Contra Account</label><select id="contra"   style="width: 170px;height:30px;">
	    <option value="1">Cash In Hand</option>
	    <option value="2">Cash In Bank</option>
	</select></div>
    <div  style="margin-top:10px;margin-right:5px; margin-bottom:30px;">

<input type="submit" id="subs" name="" class="btn btn-success btn-visitor-delete" style="float:right; width: 170px;">
</div>
@endforeach
</form>
</div>
<table class="table table-bordered table-striped" style="margin-top:70px;">
        <thead>
            <tr>
                <th width="50px">ID</th>

                <th  width="100px">Type</th>
                <th width="150px">Name</th>
                <th>Details</th>
                <th width="75px">Amount</th>
                <th   width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <span style="float:right; margin-right: 100px;">Total Payments <input type="text" name="" id="lpay" readonly></span>
</div>
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
      var route = "{{ url('autopayment-now') }}";
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
var bid = "<?php echo $bid; ?>";
var contra=$("#contra").find(':selected').val();
        var pid = $("input[name=pid]").val();
        var pname = $("input[name=payname]").val();
        var pdetails = $("input[name=paydetails]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('recovery_single') }}";
        if(pname==''){
           alert("Add Person Name");
           return;
        }
        if(pdetails==''){
           alert("Add Details");
           return;
        }
        if(pamount==''){
           alert("Add Amount");
           return;
        }
        if(pdate==''){
           alert("Add Date");
           return;
        }
        $.ajax({
           url:url,
           method:'GET',
           data:{
                pid:pid,
                bid:bid,
                  pname:pname,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
                  contra:contra,
                },
           success:function(response){
               
              if(response.success){
              
                 alert(response.success)
               
               location.reload();
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
        $.each(response.stx,function(key,item){
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.book[0].name+"</td><td>"+item.details+"</td><td>"+item.amount+"</td><td><a  value='"+item.id+"'style='margin-left:10px; height:30px;text-align:center;' href='#' onclick='mts("+item.id+")'  class='btn btn-danger btn-visitor-delete'>Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("tbody").append(bodyData);
    }

});
        
     
    };
    function mts(a){
        var result = confirm("Do You Want to delete?");
  if (result==true) {
   //alert("Yes");
 
  var url = "{{ url('recoverydelete') }}";
        
        $.ajax({
           url:url,
           method:'GET',
           data:{
                pid:a,
                },
           success:function(response){
               
              if(response.success){
              
                 alert(response.success)
               location.reload();
               
                   //Message come from controller

              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });

    } else {
    alert("Thanks God You saved....");
  }
       }   


  </script>
@endsection