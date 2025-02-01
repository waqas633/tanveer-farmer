@extends('layout')
@section('container')
<div class="container">
<div class="tabs">
        <button class="tab-buttonbtn btn-danger" onclick="openTab('tab1')" style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Bank Payments</button>
        <button class="tab-buttonbtn btn-primary" onclick="openTab('tab2')" style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Cash Payments</button>
    </div>
    <div id="tab1"  class="tab-content active">
      <div class="container">
<h1>Bank Recoveries</h1>
<div>
<form   onsubmit="return false">
<div>
	<label style="width:120px;float:left; height: 20px;">ID</label><input type="text" id="inv" name="inv" value="{{$ssid1}}" style="width: 170px;" readonly></div>
<div style="margin-top:10px;">	
    <label  style="width:120px;float:left;">Date</label><input type="date" id="pdate" name="pdate" style="width: 170px;" value="<?php echo date('Y-m-d'); ?>"> <button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#bankModal" id="data-btn-btn">Get Data</button></div>
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
    <div  style="margin-top:10px;margin-right:5px; margin-bottom:30px;margin-left: 110px;">

        <button class="btn btn-success"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" name="subs" id="subs" >Save</button><button class="btn btn-success" id="updateButton" disabled style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Update</button>
<button class="btn mb-2 mb-md-0 btn-primary"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">New</button>
<button class="btn btn-danger"  disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Delete</button>
<button class="btn btn-danger"  onclick="location.href='/welcome';"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Main Menu</button>
</div>
</form>
</div>


<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50px">TR.ID</th>

                <th  width="200px">Payee</th>
                <th   width="100px">Amount</th>
                <th width="200px">Receiver</th>
                <th   width="100px">Amount</th>
                <th width="75px">Bank</th>
                <th>Details</th>
            </tr>
        </thead>
       <tbody>
            @foreach ($stx->where('type','Banks') as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->pbook->name}}</td>
              <td>{{$item->cr}}</td>
              <td>{{$item->rbook->name}}</td>
              <td>{{$item->dr}}</td>
              <td>{{$item->bank->name}}</td>
              <td>{{$item->discription}}</td>
              
            </tr>
            @endforeach
        </tbody>
        <tbody>
            <tr>
              <td></td>
              <td></td>
              <td>{{$stx->where('type','Banks')->sum('cr')}}</td>
              <td></td>
              <td>{{$stx->where('type','Banks')->sum('dr')}}</td>
              <td></td>
              <td></td>
              <td></td>
              
              
            </tr>
        </tbody>
    </table>
    
    <div style="float:right; margin-right: 100px;">Total Payments <input type="text" name="" value="{{$stx->SUM('amount')}}"  id="lpay" readonly></div>
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
      
    </div>
    <div id="tab2" class="tab-content">
       <div class="container">
<h1>Cash Recoveries</h1>
<div>
<form   onsubmit="return false">
<div>
	<label style="width:120px;float:left; height: 20px;">ID</label><input type="text" id="inv1" name="inv1" value="{{$ssid}}" style="width: 170px;" readonly></div>
<div style="margin-top:10px;">	
    <label  style="width:120px;float:left;">Date</label><input type="date" id="pdate1" name="pdate1" style="width: 170px;" value="<?php echo date('Y-m-d'); ?>"><button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#cashModal" id="data-btn-btn-1">Get Data</button></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Account</label><input type="text" name="rid1" id="rid1" style="width: 30px" style="display:none"><input type="text" name="recname1" id="recname1" style="width: 270px;"  disabled><button class="btn btn-success" style="margin-left: 10px"  data-toggle="modal"  data-target="#myModal1"  onclick="purchaseSelect()" >Search</button><input type="text"  style="margin-left:10px;" id="obalance1" placeholder="Opening Balance" disabled></div>
    <div  style="margin-top:10px;">
      <label  style="width:120px;float:left;"></label><input type="radio" id="rec1" value="2" name="type1" onclick="reco()"><label style="margin-left:10px;"> Received By</label><input type="radio" name="type1" id="pay1" value="1"  style="margin-left:10px;"  onclick="reco()"><label style="margin-left:10px;"  onclick="reco()">Paid By</label></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Amount</label><input type="text" id="payamount1" name="payamount1" onkeyup="reco()"><input type="text"  style="margin-left:10px;" id="cbalance1" name="cbalance1" placeholder="Closing Balance" disabled></div>
	<div  style="margin-top:10px;">
    <label  style="width:120px;float:left;">Discription</label>
<textarea rows="3" cols="50" id="discription1" name="discription1"></textarea>
</div>
    <div  style="margin-top:10px;margin-right:5px; margin-bottom:30px;margin-left: 110px;">

        <button class="btn btn-success"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" name="subs1" id="subs1">Save</button><button disabled class="btn btn-danger" id="updateButton1"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Update</button>
<button class="btn mb-2 mb-md-0 btn-primary"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">New</button>
<button class="btn btn-danger"  disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Delete</button>
<button class="btn btn-danger"  onclick="location.href='/welcome';"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Main Menu</button>
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
                
                <th   width="100px">Credit</th>
                <th   width="100px">Debit</th>
            </tr>
        </thead>
        
      
          <tbody id="ttbodyCash1">
             @foreach ($stxcash as $item)
            <tr>
              <td>{{$item->id}}</td>
              
              <td>@if($item->type=="1")
<label>Payment</label> 
@endif
@if ($item->type=="2")  
<label>Recovery</label>                              
                @endif


              </td>
               <td>
<label>{{$item->pbook->name}}</label>                              
             


              </td>
              <td>{{$item->discription}}</td>
              <td>{{$stx->where('type','CashRecovery')->where('id',$item->id)->pluck('cr')->first()}}</td><td>
{{$stx->where('type','CashRecovery')->where('id',$item->id)->pluck('dr')->first()}}

              </td>
            </tr>
            @endforeach
        </tbody>
        <tbody id="ttbodyCash2">
          <tr>
            <td colspan="4" align="center">Total Cash</td>
            <td>{{$stx->where('type','CashRecovery')->SUM('cr')}}</td><td>{{$stx->where('type','CashRecovery')->SUM('dr')}}</td>
            <td></td>
        </tbody>
         <tbody  id="ttbodyCash">
          </tbody>
    </table>
    
    <div style="float:right; margin-right: 100px;">Total Payments <input type="text" value="{{$stxcash->SUM('amount')}}" name="" id="lpay" readonly></div>
    </div>
 <!-- The Modal -->
 <div class="modal" id="myModal1">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Choose User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal Body -->
        <div class="modal-body">
          <input type="text" style="width: 100%;padding-top:10px;padding-bottom:10px" placeholder="Search Name"  id="searchInputPartyCash"><br/>
          <select style="height: 40px;width: 100%;margin-top:10px;" id="searchTyping1" onchange="changeSelectcash()">
            @foreach ($acctype as $item)
                
            <option value="{{$item->id}}">{{$item->type}}</option>
            @endforeach
          </select>
  
          <table class="table table-bordered table-striped" style="margin-top:10px;" id="partyaccounttablecash">
            <thead>
                <tr>
                    <th width="75px">No</th>
                    <th>Party</th>
                    <th style="">Type</th>
                    <th style="">Balance</th>
                </tr>
            </thead>
            <tbody id="partytableBody1">
              @foreach ($bk13 as $item)
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

    </div>
  </div> 
  <!-- Bank Modal -->
<div class="modal" id="bankModal">
  <div class="modal-dialog" style="min-width: 100%;
  margin: 0;
min-height: 100vh;">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Bank Recoveries</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
       <label style="width: 75px">Select Date</label>
        <input type="date" id="getdates" name="getdates" style="width: 100px" value="<?php echo $date=date("Y-m-d");?>">  <input type="submit"   onclick="getData()" value="Search">
        <table class="table table-bordered table-striped" style="margin-top:10px;">
        <thead>
            <tr>
                <th width="50px">TR.ID</th>

                <th width="200px">Payee</th>
                 <th width="100px">Amount</th>
                <th width="200px">Receiver</th>
                 <th width="100px">Amount</th>
                <th width="150px">Bank</th>
                <th>Details</th>
                <th>Options</th>
            </tr>
        </thead>
          <tbody  id="ttbodyBank">
          </tbody>
          <tbody id="ttbodyBank1">
            @foreach ($stx->where('type','Banks') as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->pbook->name}}</td>
              <td>{{$item->cr}}</td>
              <td>{{$item->rbook->name}}</td>
              <td>{{$item->dr}}</td>
              <td>{{$item->bank->name}}</td>
              <td>{{$item->discription}}</td>
              <td><a href="#"  onclick="mts({{$item->id}})"><i class="fa fa-recycle"></i>Update</a></td>
              
              
            </tr>
            @endforeach
        </tbody>
        <tbody id="ttbodyBank2">
            <tr>
              <td></td>
              <td></td>
              <td>{{$stx->where('type','Banks')->sum('cr')}}</td>
              <td></td>
              <td>{{$stx->where('type','Banks')->sum('dr')}}</td>
              <td></td>
              <td></td>
              <td></td>
              
              
            </tr>
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
 <!-- End Bank Modal -->
 
  <!-- Cash Modal -->
<div class="modal" id="cashModal">
  <div class="modal-dialog" style="min-width: 100%;
  margin: 0;
min-height: 100vh;">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cash Recoveries</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
       <label style="width: 75px">Select Date</label>
        <input type="date" id="getdates1" name="getdates1" style="width: 100px" value="<?php echo $date=date("Y-m-d");?>">  <input type="submit"   onclick="getData1()" value="Search">
        <table class="table table-bordered table-striped" style="margin-top:10px;">
     <thead>
            <tr>
                <th width="50px">ID</th>
                <th width="100px">Type</th>
                <th width="200px">Person</th>
                
                <th>Details</th>
                
                <th width="100px">Credit</th>
                <th width="100px">Debit</th>
                <th width="100px">Option</th>
            </tr>
        </thead>
          <tbody  id="ttbodycash">
          </tbody>
          <tbody>
             @foreach ($stxcash as $item)
            <tr>
             <td>{{$item->id}}</td>
              
              <td>@if($item->type=="1")
<label>Payment</label> 
@endif
@if ($item->type=="2")  
<label>Recovery</label>                              
                @endif


              </td>
               <td>
<label>{{$item->pbook->name}}</label>                              
             


              </td>
              <td>{{$item->discription}}</td>
              <td>{{$stx->where('type','CashRecovery')->where('id',$item->id)->pluck('cr')->first()}}</td><td>
{{$stx->where('type','CashRecovery')->where('id',$item->id)->pluck('dr')->first()}}

              </td>
              <td><a href="" onclick="mtdcash({{$item->id}})"><i class="fa fa-trash"></i>Delete</a><br/><a href="#"  onclick="mtscash({{$item->id}})"><i class="fa fa-recycle" onclick=""></i>Update</a></td>
              
            </tr>
            @endforeach
        </tbody>
        <tbody>
          <tr>
            <td colspan="4" align="center">Total Cash</td>
            <td>{{$stx->where('type','CashRecovery')->SUM('cr')}}<td></td>{{$stx->where('type','CashRecovery')->SUM('dr')}}</td>
            <td></td>
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
 <!-- End Cash Modal -->
  <script>
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
        $('#data-btn-btn-1').focus(); 
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
 $('#bankModal').modal('hide');
    $('.modal-backdrop').remove();
document.getElementById("rid").value=response.singleEntry.pid;
document.getElementById("pid").value=response.singleEntry.rid;
document.getElementById("recname").value=response.singleEntry.pbook.name;
document.getElementById("payname").value=response.singleEntry.rbook.name;
// document.getElementById("obalance").value=response.pur_balance[0].blnc;
document.getElementById("bank_id").value = response.singleEntry.bank_id;
document.getElementById("payamount").value=response.singleEntry.cr;
document.getElementById("discription").value=response.singleEntry.discription;
document.getElementById("cbalance").value=parseFloat(response.pur_balance[0].blnc)+parseFloat(response.singleEntry.amount);
console.log(response.singleEntry.type);
 $('#bankModal').modal('hide');
    $('.modal-backdrop').remove();

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
    $('.modal-backdrop').remove();
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
       function formerSelect() {
     document.getElementById("searchInputParty").value='';
    partyType = "Former";
    document.getElementById("searchTyping").value = "1";
    // console.log(partyType);
    var newparty = partyType.trim().toLowerCase();

    $("#partytableBody tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
}
    function purchaseSelect(){
       document.getElementById("searchInputParty").value='';
    partyType="Purchaser";
    // document.getElementById("searchTyping").value = "2";
    // console.log(partyType);
    // var newparty=partyType.trim().toLowerCase()
    // $("#partytableBody tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    // });
        document.getElementById("searchTyping").value = "2";
    // console.log(partyType);
    var newparty = partyType.trim().toLowerCase();

    $("#partytableBody tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
  }
  function changeSelect(){
partyType2=$("#searchTyping").find(':selected').text();
    // console.log(partyType2);
     var newparty=partyType2.toLowerCase()
      $("#partytableBody tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
}
  
  
  
  
  
  
  
  //for cash requiry
     function mtdcash(a){
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
  $("#searchInputPartyCash").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#partytableBody1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
var rows = document.getElementById("partyaccounttablecash").getElementsByTagName("tr");
for (var i = 0; i < rows.length; i++) {
  rows[i].addEventListener("click", function() {
    var cells = this.getElementsByTagName("td");
    var rowData = [];
    for (var j = 0; j < cells.length; j++) {
      if(partyType=="Former"){
        document.getElementById("payname1").value=cells[1].textContent;
        document.getElementById("pid1").value=cells[0].textContent;
        document.getElementById("obalance1").value=cells[3].textContent;
      }
      if(partyType=="Purchaser"){
        document.getElementById("recname1").value=cells[1].textContent;
        document.getElementById("rid1").value=cells[0].textContent;
        document.getElementById("obalance1").value=cells[3].textContent;
      }
      console.log(cells[1].textContent);
      rowData.push(cells[j].textContent);
    }
    console.log("Clicked row data:", rowData);
    // Do whatever you need with the row data here
    $('#myModal1').modal('hide');
    $('.modal-backdrop').remove();
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
     $("#subs1").click(function(e){
          e.preventDefault();
          var type1="";
      if(document.getElementById('pay1').checked == true) {   
         type1="1" ; 
}
if(document.getElementById('rec1').checked == true) {   
         type1="2" ; 
} 
        var rid1 = $("input[name=rid1]").val();
        var invc1 = $("input[name=inv1]").val();
        // var pname = $("input[name=payname]").val();
        var pdetails1 = $("textarea[name=discription1]").val();
        var pamount1 = $("input[name=payamount1]").val();
         var pdate1 = $("input[name=pdate1]").val();
        var url = "{{ url('cash_recovery') }}";
        // if(pid==''){
        //    alert("Add Payer Name");
        //    return;
        // }
        if(rid1==''){
           alert("Add Name");
           return;
        }
        if(pdetails1==''){
           alert("Add Details");
           return;
        }
        if(pamount1==''){
           alert("Add Amount");
           return;
        }
        if(pdate1==''){
           alert("Add Date");
           return;
        }
        $.ajax({
           url:url,
           method:'GET',
           data:{
            rid:rid1,
            inv:invc1,
                  pdetails:pdetails1,
                  pamount:pamount1,
                  ddate:pdate1,
                  type:type1,
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
                                 $("#updateButton1").click(function(e){
          e.preventDefault();
          var type1="";
      if(document.getElementById('pay1').checked == true) {   
         type1="1" ; 
}
if(document.getElementById('rec1').checked == true) {   
         type1="2" ; 
} 
        var rid1 = $("input[name=rid1]").val();
        var invc1 = $("input[name=inv1]").val();
        // var pname = $("input[name=payname]").val();
        var pdetails1 = $("textarea[name=discription1]").val();
        var pamount1 = $("input[name=payamount1]").val();
         var pdate1 = $("input[name=pdate1]").val();
        var url = "{{ url('cash_recovery_update') }}";
        // if(pid==''){
        //    alert("Add Payer Name");
        //    return;
        // }
        if(rid1==''){
           alert("Add Name");
           return;
        }
        if(pdetails1==''){
           alert("Add Details");
           return;
        }
        if(pamount1==''){
           alert("Add Amount");
           return;
        }
        if(pdate1==''){
           alert("Add Date");
           return;
        }
        $.ajax({
           url:url,
           method:'GET',
           data:{
            rid:rid1,
            inv:invc1,
                  pdetails:pdetails1,
                  pamount:pamount1,
                  ddate:pdate1,
                  type:type1,
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
            var pdate1 = $("input[name=pdate1]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:pdate1,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        
        console.log(response.stx);
        document.getElementById("inv1").value = response.sid;
        document.getElementById("lpay1").value = response.pros;
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
      if(document.getElementById('pay1').checked == true) {   
         type="1" ; 
}
if(document.getElementById('rec1').checked == true) {   
         type="2" ; 
} 
      if(type=="1"){
        var obs=document.getElementById("obalance1").value
        var pays=document.getElementById("payamount1").value
        var netpay=parseFloat(obs)-parseFloat(pays);
        document.getElementById("cbalance1").value=netpay
        console.log("payment");
      }
      if(type=="2"){
        var obs=document.getElementById("obalance1").value
        var pays=document.getElementById("payamount1").value
        var netpay=parseFloat(obs)+parseFloat(pays);
        document.getElementById("cbalance1").value=netpay
        console.log("Recovery");
      }
    }

    function mtscash(a){
         document.getElementById("updateButton1").disabled = false;
         document.getElementById("subs1").disabled = true;
         // var pinv = $("input[name=inv]").val();
          document.getElementById("inv1").value=a;
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
document.getElementById("rid1").value=response.singleEntry.pid;
document.getElementById("recname1").value=response.singleEntry.pbook.name;
// document.getElementById("obalance1").value=response.pur_balance[0].blnc;

document.getElementById("discription1").value=response.singleEntry.discription;

console.log(response.singleEntry.type);
if (response.singleEntry.type == 2) {
    document.getElementById("obalance1").value=parseFloat(response.pur_balance[0].blnc)-parseFloat(response.singleEntry.amount);
    document.getElementById("payamount1").value=response.singleEntry.amount;
    document.getElementById("cbalance1").value=parseFloat(response.pur_balance[0].blnc);
    $('#rec1').prop('checked', true);
    $('#pay1').prop('checked', false); // Uncheck the other checkbox
} else {
    document.getElementById("obalance1").value=parseFloat(response.pur_balance[0].blnc)+parseFloat(response.singleEntry.amount);
     document.getElementById("payamount1").value=response.singleEntry.amount;
    document.getElementById("cbalance1").value=parseFloat(response.pur_balance[0].blnc);
    $('#pay1').prop('checked', true);
    $('#rec1').prop('checked', false); // Uncheck the other checkbox
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
 $('#cashModal').modal('hide');
    $('.modal-backdrop').remove();
       }
 function formerSelect() {
     document.getElementById("searchInputParty").value='';
    partyType = "Former";
    document.getElementById("searchTyping").value = "1";
    // console.log(partyType);
    var newparty = partyType.trim().toLowerCase();

    $("#partytableBody tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
}
  function purchaseSelect(){
       document.getElementById("searchInputParty").value='';
    partyType="Purchaser";
    // document.getElementById("searchTyping").value = "2";
    // console.log(partyType);
    // var newparty=partyType.trim().toLowerCase()
    // $("#partytableBody tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    // });
        document.getElementById("searchTyping").value = "2";
    // console.log(partyType);
    var newparty = partyType.trim().toLowerCase();

    $("#partytableBody tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
  }
  function changeSelectcash(){
      partyType2=$("#searchTyping1").find(':selected').text();
    // console.log(partyType2);
     var newparty=partyType2.toLowerCase()
      $("#partytableBody1 tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
      
      
      //change
// partyType2=$("#searchTyping1").find(':selected').text();
//     console.log(partyType2);
//      var newparty=partyType2.toLowerCase()
//     // var newparty=1;
//     $("#partytableBody1 tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
//     });
  }
function getData(){
            var url = "{{ url('fetch-recovery-datewise') }}";
            var inv = $("input[name=getdates]").val();
          console.log(inv); 
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  date:inv,
                },
    success:function(response){
        var ids=1;
        var bodyData3 = '';
console.log(response);
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
const filteredItems = response.stx.filter(item => item.type === 'Banks');
console.log(filteredItems);
      $.each(filteredItems, function(key, item) {
            $("#ttbodyBank").html(""); 
            $("#ttbodyBank1").html(""); 
            $("#ttbodyBank2").html(""); 
     bodyData3+="<tr>"
                    bodyData3+="<td>"+ids+"</td><td>"+item.rbook.name+"</td><td>"+item.cr+"</td><td>"+item.pbook.name+"</td><td>"+item.dr+"</td><td>"+(item.bank?.name || 0)+"</td><td>"+item.discription+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mts("+item.id+")'><i class='fa fa-recycle'></i> Update</a></td>";
                    
                    bodyData3+="</tr>";
                    ids=ids+1;
                    table_former_amount=table_former_amount+parseFloat(item.cr);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.dr);
        })
        bodyData3+="<td></td><td></td><td>"+table_former_amount+"</td><td></td><td>"+table_former_amount+"</td><td></td><td>";
        var sa=0;
        var dis=0;
        // console.log(response.sbook);
        $("#ttbodyBank").append(bodyData3);
    }

});

        }
        function getData1(){
            var url = "{{ url('fetch-cash-recovery-datewise') }}";
            var inv = $("input[name=getdates1]").val();
          console.log(inv); 
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  date:inv,
                },
    success:function(response){
        var ids=1;
        var bodyData3 = '';
console.log(response);
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
const filteredItems = response.stx.filter(item => item.type === 'CashRecovery');
console.log(filteredItems);
   $("#ttbodyCash1").html(""); 
            $("#ttbodyCash2").html(""); 
            $("#ttbodycash").html(""); 
      $.each(filteredItems, function(key, item) {
         console.log(item);
   bodyData3 += "<tr>";
bodyData3 += "<td>" + item.id + "</td><td>";

if (item.tran_type === "2") {
    bodyData3 += "<label>Payment</label>";
} else if (item.tran_type === "1") {
    bodyData3 += "<label>Recovery</label>";
}

bodyData3 += "</td><td>";

if (item.tran_type === "2") {
    bodyData3 += "<label>" + (item.rbook?.name || "") + "</label>";
} else if (item.tran_type === "1") {
    bodyData3 += "<label>" + (item.pbook?.name || "") + "</label>";
}

bodyData3 += "</td><td>" + item.discription + "</td><td>" + item.cr + "</td><td>" + item.dr + "</td><td><a href='#' onclick='mtscash(" + item.id + ")'><i class='fa fa-recycle'></i> Update</a></td>";

bodyData3 += "</tr>";
                    ids=ids+1;
                    table_former_amount=table_former_amount+parseFloat(item.cr);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.dr);
        })
        $("#ttbodycash").append(bodyData3);
        bodyData3+="<td></td><td></td><td>"+table_former_amount+"</td><td></td><td>"+table_former_amount+"</td><td></td><td>";
        var sa=0;
        var dis=0;
        // console.log(response.sbook);
        $("#ttbodycash").append(bodyData3);
    }

});

        }
        $(document).ready(function() {
    $('#myModal').on('shown.bs.modal', function () {
        $('#searchInputParty').focus();
    });
    $('#data-btn-btn').focus(); 
});
  </script>
  

@endsection