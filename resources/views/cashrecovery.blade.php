@extends('layout')
@section('container')
<div class="container">
<h1>Cash Recoveries</h1>
<div>
<form   onsubmit="return false">
<div>
	<label style="width:120px;float:left; height: 20px;">ID</label><input type="text" id="inv" name="inv" value="{{$ssid}}" style="width: 170px;" readonly></div>
<div style="margin-top:10px;">	
    <label  style="width:120px;float:left;">Date</label><input type="date" id="pdate" name="pdate" style="width: 170px;" value="<?php echo date('Y-m-d'); ?>"></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Account</label><input type="text" name="rid" id="rid" style="width: 30px" style="display:none"><input type="text" name="recname" id="recname" style="width: 270px;"  disabled><button class="btn btn-success" style="margin-left: 10px"  data-toggle="modal"  data-target="#myModal"  onclick="purchaseSelect()" >Search</button><input type="text"  style="margin-left:10px;" id="obalance" placeholder="Opening Balance" disabled></div>
    <div  style="margin-top:10px;">
      <label  style="width:120px;float:left;"></label><input type="radio" id="rec" value="2" name="type" onclick="reco()"><label style="margin-left:10px;"> Received By</label><input type="radio" name="type" id="pay" value="1"  style="margin-left:10px;"  onclick="reco()"><label style="margin-left:10px;"  onclick="reco()">Paid By</label></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Amount</label><input type="text" id="payamount" name="payamount" onkeyup="reco()"><input type="text"  style="margin-left:10px;" id="cbalance" name="cbalance" placeholder="Closing Balance" disabled></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Discription</label>
<textarea rows="3" cols="50" id="discription" name="discription"></textarea>
</div>
    <div  style="margin-top:10px;margin-right:5px; margin-bottom:30px; float: right;">

        <button class="btn btn-success"  style="margin-left:10px; " name="subs" id="subs">Save</button><button disabled class="btn btn-danger" id="updateButton"  style="margin-left:10px; ">Update</button>
</div>
</form>
</div>


<table class="table table-bordered table-striped" style="margin-top:70px;">
        <thead>
            <tr>
                <th width="50px">ID</th>
                <th  width="100px">Type</th>
                <th  width="200px">Person</th>
                
                <th>Details</th>
                
                <th   width="100px">Amount</th>
                <th   width="100px">Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stx as $item)
            <tr>
              <td>{{$item->id}}</td>
              
              <td>@if($item->type=="1")
<label>Payment</label> 
@endif
@if ($item->type=="2")  
<label>Recovery</label>                              
                @endif


              </td>
              <td>{{$item->pbook->name}}</td>
              <td>{{$item->discription}}</td>
              <td>{{$item->amount}}</td>
              <td><a href="" onclick="mtd({{$item->id}})"><i class="fa fa-trash"></i>Delete</a><br/><a href="#"  onclick="mts({{$item->id}})"><i class="fa fa-recycle" onclick=""></i>Update</a></td>
              
            </tr>
            @endforeach
        </tbody>
        <tbody>
          <tr>
            <td colspan="4" align="center">Total Cash</td>
            <td>{{$sumall}}</td>
            <td></td>
        </tbody>
    </table>
    
    <div style="float:right; margin-right: 100px;">Total Payments <input type="text" value="{{$sumall}}" name="" id="lpay" readonly></div>
    </div>
 <!-- The Modal -->
 <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Choose User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal Body -->
        <div class="modal-body">
          <input type="text" style="width: 100%;padding-top:10px;padding-bottom:10px" placeholder="Search Name"  id="searchInputParty"><br/>
          <select style="height: 40px;width: 100%;margin-top:10px;" id="searchTyping" onchange="changeSelect()">
            @foreach ($acctype as $item)
                
            <option value="{{$item->id}}">{{$item->type}}</option>
            @endforeach
          </select>
  
          <table class="table table-bordered table-striped" style="margin-top:10px;" id="partyaccounttable">
            <thead>
                <tr>
                    <th width="75px">No</th>
                    <th>Party</th>
                    <th style="">Type</th>
                    <th style="">Balance</th>
                </tr>
            </thead>
            <tbody id="partytableBody">
              @foreach ($bk12 as $item)
              <tr>
                <td>{{$item->book->id ??0}}</td>
                <td>{{$item->book->name  ??0}}</td>
                <td>{{$item->book->type ??0}}</td>
                <td>{{$item->balance}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
        </div>
  
        
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script type="text/javascript">
    function mtd(a){
            var result = confirm("Do You Want to delete?");
  if (result==true) {       
        
var url = "{{ url('deleteCashRecovery') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        a:a,
                    },
    success:function(response){

      if(response.success){
              
                 alert(response.success)
                 location.reload();
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }

    }

});
} else {
    // alert("Thanks God You saved....");
  }

// fetchstudent();
       } 
  	 var partyType;
    $(document).ready(function(){
  $("#searchInputParty").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#partytableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
var rows = document.getElementById("partyaccounttable").getElementsByTagName("tr");
for (var i = 0; i < rows.length; i++) {
  rows[i].addEventListener("click", function() {
    var cells = this.getElementsByTagName("td");
    var rowData = [];
    for (var j = 0; j < cells.length; j++) {
      if(partyType=="Former"){
        document.getElementById("payname").value=cells[1].textContent;
        document.getElementById("pid").value=cells[0].textContent;
        document.getElementById("obalance").value=cells[3].textContent;
      }
      if(partyType=="Purchaser"){
        document.getElementById("recname").value=cells[1].textContent;
        document.getElementById("rid").value=cells[0].textContent;
        document.getElementById("obalance").value=cells[3].textContent;
      }
      console.log(cells[1].textContent);
      rowData.push(cells[j].textContent);
    }
    console.log("Clicked row data:", rowData);
    // Do whatever you need with the row data here
     $('#myModal').modal({ backdrop: 'static', keyboard: false, show: false });
    $('#myModal').modal('hide');
   
  });
}
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
          var type="";
      if(document.getElementById('pay').checked == true) {   
         type="1" ; 
}
if(document.getElementById('rec').checked == true) {   
         type="2" ; 
} 
        var rid = $("input[name=rid]").val();
        var invc = $("input[name=inv]").val();
        // var pname = $("input[name=payname]").val();
        var pdetails = $("textarea[name=discription]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('cash_recovery') }}";
        // if(pid==''){
        //    alert("Add Payer Name");
        //    return;
        // }
        if(rid==''){
           alert("Add Name");
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
            rid:rid,
            inv:invc,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
                  type:type,
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
                                 //update button programming
                                 $("#updateButton").click(function(e){
          e.preventDefault();
          var type="";
      if(document.getElementById('pay').checked == true) {   
         type="1" ; 
}
if(document.getElementById('rec').checked == true) {   
         type="2" ; 
} 
        var rid = $("input[name=rid]").val();
        var invc = $("input[name=inv]").val();
        // var pname = $("input[name=payname]").val();
        var pdetails = $("textarea[name=discription]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('cash_recovery_update') }}";
        // if(pid==''){
        //    alert("Add Payer Name");
        //    return;
        // }
        if(rid==''){
           alert("Add Name");
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
            rid:rid,
            inv:invc,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
                  type:type,
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
                                 //update button programming end now
    fetchpayments();
        function fetchpayments(){
            var url = "{{ url('cashRecovery') }}";
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
        document.getElementById("inv").value = response.sid;
        document.getElementById("lpay").value = response.pros;
        $("tot").append(response.pros);
        // $("tbody").html("");
    //     $.each(response.stx,function(key,item){
    //  bodyData+="<tr>"
    //                 bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.book[0].name+"</td><td>"+item.details+"</td><td>"+item.amount+"</td><td><a  value='"+item.id+"'style='margin-left:10px; height:30px;text-align:center;' href='#' onclick='mts("+item.id+")'  class='btn btn-danger btn-visitor-delete'>Delete</a></td>";
                    
    //                 bodyData+="</tr>";
    //                 ids=ids+1;
    //     })
    //     $("tbody").append(bodyData);
    }

});
        
     
    };
    function reco(){
      //rec 2
     var type="";
      if(document.getElementById('pay').checked == true) {   
         type="1" ; 
}
if(document.getElementById('rec').checked == true) {   
         type="2" ; 
} 
      if(type=="1"){
        var obs=document.getElementById("obalance").value
        var pays=document.getElementById("payamount").value
        var netpay=parseFloat(obs)-parseFloat(pays);
        document.getElementById("cbalance").value=netpay
        console.log("payment");
      }
      if(type=="2"){
        var obs=document.getElementById("obalance").value
        var pays=document.getElementById("payamount").value
        var netpay=parseFloat(obs)+parseFloat(pays);
        document.getElementById("cbalance").value=netpay
        console.log("Recovery");
      }
    }

    function mts(a){
         document.getElementById("updateButton").disabled = false;
         document.getElementById("subs").disabled = true;
         // var pinv = $("input[name=inv]").val();
          document.getElementById("inv").value=a;
          var url = "{{ url('getCashRecoveryUpdate') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        a:a,
                    },
    success:function(response){
console.log(response);
document.getElementById("rid").value=response.singleEntry.pid;
document.getElementById("recname").value=response.singleEntry.pbook.name;
document.getElementById("obalance").value=response.pur_balance[0].blnc;
document.getElementById("payamount").value=response.singleEntry.amount;
document.getElementById("discription").value=response.singleEntry.discription;
document.getElementById("cbalance").value=parseFloat(response.pur_balance[0].blnc)+parseFloat(response.singleEntry.amount);
console.log(response.singleEntry.type);
if (response.singleEntry.type == 2) {
    $('#rec').prop('checked', true);
    $('#pay').prop('checked', false); // Uncheck the other checkbox
} else {
    $('#pay').prop('checked', true);
    $('#rec').prop('checked', false); // Uncheck the other checkbox
}
// if(response.singleEntry.type==2){
//  // document.getElementById('rec').checked;
//   $('#rec').attr('checked', true);
// }
// // if(response.singleEntry.type=="1"){
//   else{
//   // document.getElementById('paye').checked;
//   $('#pay').attr('checked', true);
// }
      // if(response.success){
              
      //            alert(response.success)
               
               
      //              //Message come from controller

      //         }else{
      //             alert("Error")
      //         }

    }

});
       }
       function formerSelect(){
    partyType="Former";
    document.getElementById("searchTyping").value = "1";
    console.log(partyType);
     var newparty=partyType.toLowerCase()
    // var newparty=1;
    $("#partytableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    });
  }
  function purchaseSelect(){
    partyType="Purchaser";
    document.getElementById("searchTyping").value = "2";
    console.log(partyType);
    var newparty=partyType.toLowerCase()
    $("#partytableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    });
  }
  function changeSelect(){
partyType2=$("#searchTyping").find(':selected').text();
    console.log(partyType2);
     var newparty=partyType2.toLowerCase()
    // var newparty=1;
    $("#partytableBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    });
  }

  </script>
@endsection