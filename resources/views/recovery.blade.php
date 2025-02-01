@extends('layout')
@section('container')
<div class="container">
<h1>Bank Recoveries</h1>
<div>
<form   onsubmit="return false">
<div>
	<label style="width:120px;float:left; height: 20px;">ID</label><input type="text" id="inv" name="inv" style="width: 170px;" readonly></div>
<div style="margin-top:10px;">	
    <label  style="width:120px;float:left;">Date</label><input type="date" id="pdate" name="pdate" style="width: 170px;" value="<?php echo date('Y-m-d'); ?>"></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Received By</label><input type="text" name="rid" id="rid" style="width: 30px;" disabled style="display:none"><input type="text" name="recname" id="recname" style="width: 270px;"  disabled><button class="btn btn-success" style="margin-left: 10px"  data-toggle="modal"  data-target="#myModal"  onclick="purchaseSelect()" >Search</button></div>
    <div  style="margin-top:10px;">
        <label  style="width:120px;float:left;">Bank Account</label>
    <select style="width: 270px; height:30px;" id="bank_id" name="bank_id">
        @foreach($banks as $item)
<option value="{{$item->id}}">
{{$item->name}}
</option>
@endforeach

    </select>
    
    </div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Paid By</label><input type="text" id="pid" name="pid" style="width: 30px" disabled  style="display:none"><input type="text" id="payname" name="payname"  style="width: 270px;"  disabled> <button class="btn btn-success"  style="margin-left: 10px" data-toggle="modal"  data-target="#myModal"   onclick="formerSelect()">Search</button></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Amount</label><input type="text" id="payamount" name="payamount"></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Discription</label>
<textarea rows="3" cols="50" id="discription" name="discription"></textarea>
</div>
    <div  style="margin-top:10px;margin-right:5px; margin-bottom:30px; float: right;">

        <button class="btn btn-success"  style="margin-left:10px; " name="subs" id="subs">Save</button><button class="btn btn-success" id="updateButton" disabled style="margin-left:10px; ">Update</button>
</div>
</form>
</div>


<table class="table table-bordered table-striped" style="margin-top:70px;">
        <thead>
            <tr>
                <th width="50px">TR.ID</th>

                <th  width="200px">Payee</th>
                <th width="200px">Receiver</th>
                <th width="75px">Bank</th>
                <th>Details</th>
                
                <th   width="100px">Amount</th>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($stx as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->pbook->name}}</td>
              <td>{{$item->rbook->name}}</td>
              <td>{{$item->bank->name}}</td>
              <td>{{$item->discription}}</td>
              <td>{{$item->amount}}</td>
              <td><a href="" onclick="mtd({{$item->id}})"><i class="fa fa-trash"></i>Delete</a><br/><a href="#"  onclick="mts({{$item->id}})"><i class="fa fa-recycle"></i>Update</a></td>
              
              
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div style="float:right; margin-right: 100px;">Total Payments <input type="text" name="" id="lpay" readonly></div>
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
                    <th style="">Account</th>
                </tr>
            </thead>
            <tbody id="partytableBody">
              @foreach ($bk12 as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->type}}</td>
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
  function openTab(tabId) {
    // Hide all tab contents
    var tabs = document.getElementsByClassName('tab-content');
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove('active');
    }
    
    // Show the selected tab content
    document.getElementById(tabId).classList.add('active');
}

   function mts(a){
         document.getElementById("updateButton").disabled = false;
         document.getElementById("subs").disabled = true;
         // var pinv = $("input[name=inv]").val();
          document.getElementById("inv").value=a;
          var url = "{{ url('getBankRecoveryUpdate') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        a:a,
                    },
    success:function(response){
console.log(response);
// var bank_ids=$("#bank_id").find(':selected').val();
//         var pid = $("input[name=pid]").val();
//         var rid = $("input[name=rid]").val();
//         var invc = $("input[name=inv]").val();
//         // var pname = $("input[name=payname]").val();
//         var pdetails = $("textarea[name=discription]").val();
//         var pamount = $("input[name=payamount]").val();
//          var pdate = $("input[name=pdate]").val();
document.getElementById("rid").value=response.singleEntry.pid;
document.getElementById("pid").value=response.singleEntry.rid;
document.getElementById("recname").value=response.singleEntry.pbook.name;
document.getElementById("payname").value=response.singleEntry.rbook.name;
// document.getElementById("obalance").value=response.pur_balance[0].blnc;
document.getElementById("bank_id").value = response.singleEntry.bank_id;
document.getElementById("payamount").value=response.singleEntry.amount;
document.getElementById("discription").value=response.singleEntry.discription;
document.getElementById("cbalance").value=parseFloat(response.pur_balance[0].blnc)+parseFloat(response.singleEntry.amount);
console.log(response.singleEntry.type);

    }

});
       }
   function mtd(a){
            var result = confirm("Do You Want to delete?");
  if (result==true) {       
        
var url = "{{ url('deleteBankRecovery') }}";
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
      }
      if(partyType=="Purchaser"){
        document.getElementById("recname").value=cells[1].textContent;
        document.getElementById("rid").value=cells[0].textContent;

      }
      console.log(cells[1].textContent);
      rowData.push(cells[j].textContent);
    }
    console.log("Clicked row data:", rowData);
    // Do whatever you need with the row data here
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
        //update button start here
        $("#updateButton").click(function(e){
          e.preventDefault();
        var bank_ids=$("#bank_id").find(':selected').val();
        var pid = $("input[name=pid]").val();
        var rid = $("input[name=rid]").val();
        var invc = $("input[name=inv]").val();
        // var pname = $("input[name=payname]").val();
        var pdetails = $("textarea[name=discription]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('recovery_bank_update') }}";
        if(pid==''){
           alert("Add Payer Name");
           return;
        }
        if(rid==''){
           alert("Add Recovorer Name");
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
            bank_id:bank_ids,
            rid:rid,
            inv:invc,
                pid:pid,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
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
        // update button end here
     $("#subs").click(function(e){
          e.preventDefault();
        var bank_ids=$("#bank_id").find(':selected').val();
        var pid = $("input[name=pid]").val();
        var rid = $("input[name=rid]").val();
        var invc = $("input[name=inv]").val();
        // var pname = $("input[name=payname]").val();
        var pdetails = $("textarea[name=discription]").val();
        var pamount = $("input[name=payamount]").val();
         var pdate = $("input[name=pdate]").val();
        var url = "{{ url('recovery_bank') }}";
        if(pid==''){
           alert("Add Payer Name");
           return;
        }
        if(rid==''){
           alert("Add Recovorer Name");
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
            bank_id:bank_ids,
            rid:rid,
            inv:invc,
                pid:pid,
                  pdetails:pdetails,
                  pamount:pamount,
                  ddate:pdate,
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
            var url = "{{ url('fetch-bank-recory') }}";
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

//     function mts(a){
//         var result = confirm("Do You Want to delete?");
//   if (result==true) {
//    //alert("Yes");
 
//   var url = "{{ url('recoverydelete') }}";
        
//         $.ajax({
//            url:url,
//            method:'GET',
//            data:{
//                 pid:a,
//                 },
//            success:function(response){
               
//               if(response.success){
              
//                  alert(response.success)
//                location.reload();
               
//                    //Message come from controller

//               }else{
//                   alert("Error")
//               }
//            },
//            error:function(error){
//               console.log(error)
//            }
//         });

//     } else {
//     alert("Thanks God You saved....");
//   }
//        }
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