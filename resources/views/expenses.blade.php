@extends('layout')
@section('container')
<h1>Add Expenses</h1>
<form   onsubmit="return false">
	<span>ID</span><input type="text" id="pid" name="pid">
	<span>Date</span><input type="date" id="pdate" name="pdate" value="<?php echo date('Y-m-d'); ?>">
	 <label style="width:80px">Expense Head</label><select name="brands" id="brands" style="width: 160px;margin-top:3px;height:30px;"
              onchange = "demention()"  class="operator">
            <option value="0">Select</option></select>
	<span>Details</span><input type="text" id="paydetails" name="paydetails">
	<span>Amount</span><input type="text" id="payamount" name="payamount">
	<span>Contra Account</span><select id="contra"  name="contra">
	    <option value="0">Select</option>
	</select>
	<input type="submit" id="subs" name="" class="btn btn-danger btn-visitor-delete">
</form>
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50px">ID</th>

                <th  width="100px">Date</th>
                <th width="150px">Name</th>
                <th>Details</th>
                <th width="75px">Amount</th>
                <th   width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <span style="float:right; margin-right: 100px;">Total Expenses <input type="text" name="" id="lpay" readonly></span>
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
  var contra=$("#contra").find(':selected').val();
var head=$("#brands").find(':selected').val();
        var pid = $("input[name=pid]").val();
        var pname = 34;
        var pdetails = $("input[name=paydetails]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('expenses_single') }}";
        
        $.ajax({
           url:url,
           method:'GET',
           data:{
                pid:pid,
                  pname:pname,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
                  head:head,
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
            var url = "{{ url('fetch-expenses') }}";
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
        
        console.log(response.stx);
        document.getElementById("pid").value = response.sid+1;
        document.getElementById("lpay").value = response.pros;
        $("tot").append(response.pros);
        $("tbody").html("");
        $.each(response.stx,function(key,item){
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.expense_head.name+"</td><td>"+item.details+"</td><td>"+item.amount+"</td><td><a  value='"+item.id+"'style='margin-left:10px; height:30px;text-align:center;' href='paymentdelete1/"+item.id+"'  class='btn btn-danger btn-visitor-delete'>Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("tbody").append(bodyData);
        
         select = document.getElementById('brands');
              $('#brands').empty();
              var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        //console.log(response.booker);
        $.each(response.heads,function(key,item){
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.name;
    select.appendChild(opt);
        });
        select = document.getElementById('contra');
              $('#contra').empty();
              var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.banks,function(key,item){
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.name;
    select.appendChild(opt);
        });

    }

});
        
     
    };


  </script>
@endsection