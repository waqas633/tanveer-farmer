@extends('layout')
@section('container')

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>

   
<div class="container">

    
    <h1 align="center">{{session('firm_name')}}</h1>

  
    
        
     
         <div class="row">
    <div>


      <label style="width:80px;text-align: left;display: none">Invoice No:</label><input type="text" value="1" disabled name="inv"  style="width: 150px;display: none" id="inv" placeholder="Enter Invoice Number"><br/>
      <label style="width:80px;text-align: left;">Date</label><input type="date" name="getdate" id="getdate" style="width: 250px;"  value="<?php echo $date=date("Y-m-d");?>"> <button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#searchModal">Get Data</button>
      <label style="width:80px;text-align: left;">Rates</label><input type="text" name="rating" id="rating" style="width: 150px;" readonly="readonly" disabled  value="{{$datrate->open ?? 0}}-{{$datrate->close ?? 0}}"><button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#rateModal">Add Rate</button><br>
<label style="width:80px;text-align: left;">Party Name</label><input type="text" style="width: 30px;display: none;" id="fid" name="fid"><input type="text" name="partN" id="partN" style="margin-top: 3px;width: 350px;" value="" readonly="readonly"   disabled><button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" id="partyName"  onclick="formerSelect()" onkeyup="formerSelect()" data-target="#myModal">FARMS</button> <label style="margin-left:10px; ">Balance</label><input type="text" name="partNBalance" id="partNBalance" class="readonly-input" disabled style="margin-left:10px; "><br/>
<label style="margin-left:10px; ">VAN Number</label><input type="text" style="margin-left:10px; width:200px;" name="van" id="van"><label style="margin-left:10px; ">Weight</label><input type="number" id="pweight" name="pweight" style="margin-left:10px;  width:200px;" onkeyup="calcultedvalue()" onclick="calcultedvalue()"><label style="margin-left:10px; ">Rate</label><input type="text"  onkeyup="calcultedvalue()" id="formerrate" name="formerrate" style="margin-left:10px;  width:300px;" value="{{$datrate->open ?? 0}}"><br/>
<label style="margin-left:10px; ">Amount</label><input type="text" class="readonly-input" disabled style="margin-left:10px; " id="formeramount" name="formeramount"><label style="margin-left:10px; ">Net Balance</label><input type="text" class="readonly-input" disabled style="margin-left:10px; " name="formernetbalance" id=formernerbalance><br/>
<label style="margin-left:10px; ">Purchaser</label><input type="text" id="purid"  style="width: 30px;margin-left:10px;display: none" name="purid"><input type="text" id="partP" name="partP" style="width: 350px; " readonly="readonly" disabled> <button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#myModal" id="purchaserName" onclick="purchaseSelect()" onkeyup="purchaseSelect()">DEALERS</button> <label style="margin-left:10px; ">Balance</label><input type="text" style="margin-left:10px;width: 100px; " class="readonly-input" disabled name="partPBalance" id="partPBalance"><label style="margin-left:10px; display:none">Rate</label><input type="text"  onkeyup="calcultedvalue()" id="purchaserrate" name="purchaserrate" style="margin-left:10px;width: 100px;display:none " value="{{$datrate->close ?? 0}}"><br/>
<label style="margin-left:10px; ">Amount</label><input type="text" disabled class="readonly-input" style="margin-left:10px; " id="purchaseramount" name="purchaseramount"><label style="margin-left:10px; ">Net Balance</label><input type="text" disabled style="margin-left:10px; " class="readonly-input" id="purchasernetbalance" name="purchasernetbalance">
<label style="margin-left:10px; display:none;">Profit</label><input type="text" disabled class="readonly-input" style="margin-left:10px; " id="formprofit" name="formprofit">
<br>
<div style="margin-left: 70px;position: relative;display: -webkit-inline-box;display: -ms-inline-flexbox;display: inline-flex;vertical-align: middle;padding:20px;">
<button class="btn btn-success"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" name="subs" id="subs"    onsubmit = "fetchstudent()" onkeyup= "fetchstudent()" >Save</button>
<a  class="btn mb-2 mb-md-0 btn-primary"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" href="sales">New</a>
<button class="btn btn-success" onclick="updateWholeSale()" id="updateButton" disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Update</button>
<button class="btn btn-danger" id="deleteButton"  disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" onclick='mtd(invno)'>Delete</button>
<button class="btn btn-danger"  onclick="location.href='/welcome';"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Main Menu</button>
</div>





        
           
    <span style="display: none">
      <label style="width:50px;text-align: left;">Type</label><select name="type" id="type" style="width: 150px;margin-top:3px;height:30px;"  onchange = "branding()">
        <option>Select</option>
          <option value="1">Covered</option><option value="2">UnCovered</option>
          <option value="3">UnCovered MM</option><option value="4">Accessories</option>
          </select>
          
          <label style="width:50px">Brand</label><select name="brands" id="brands" style="width: 80px;margin-top:3px;height:30px;"
            onchange = "demention()"  class="operator">
          <option value="0">Option</option></select>
           
          
           <label style="width:100px">Demensions</label><select name="demen" id="demen" style="width: 80px;margin-top:3px;height:30px;" onchange="thinkess()">
          <option value="0">Option</option></select><br>
          <label style="width:60px">Thikness</label><select name="thik" id="thik" style="width: 80px;margin-top:3px;height:30px;"  onchange = "dementionz()">
          <option value="0">Option</option></select>
         
          <label style="width:60px">Waranty</label><select name="waran" id="waran" style="width: 80px;margin-top:3px;height:30px;">
          <option value="0">Option</option></select>
    <span><input type="text" name="units" id="units" placeholder="Units" style="width:50px;height:30px;"></span>
    <span><input type="text" name="uprice" id="uprice" placeholder="Price" style="width:50px;height:30px;"></span>
    <span><input type="text" name="disc11" id="disc11" value="0" placeholder="Discount" style="width:50px;height:30px;margin-left:5px;"></span>
    <span><input type="submit" id="subs" name="subs" class="btn btn-success" value="Add Item"   onsubmit = "fetchstudent()"><input type="text" name="netprice" id="netprice" placeholder="Net" style="width:50px;height:30px; margin-left:5px;"   onkeyup="clsdisco()"></span>
</span>
</div>

</div>




    



  
    <table class="table table-bordered table-striped" >
      <thead>
        <tr>
            <th width="3%">ID</th>
            <th  width="5%">VAN</th>
            <th  width="5%">Weight</th>
            <th  width="17%">Former</th>
            <th  width="5%">Rate</th>
            <th  width="10%">Amount</th>
            <th  width="17%">Purchaser</th>
            <!-- <th  width="5%">Rate</th>
            <th  width="10%">Amount</th>
            <th  width="5%">Profit</th> -->
        </tr>
    </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
   
    </div>
  </div>
<div style="width:300px; float:right; margin-right: 110px;"  align="right">
    <form>
    
<a id='linkx' style=" display:none" href="https://api.whatsapp.com/send/?phone=03346323649&text=">
        <img src="https://rb.bestappsapk.com/public/files/whatsapp.png" style="height:50px;width:50px; display:none">
        
    </a>
    </form>
    
</div>

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
          @foreach ($acc_type as $item)
              
          <option value="{{$item->id}}">{{$item->type}}</option>
          @endforeach
        </select>

        <table class="table table-bordered table-striped" style="margin-top:10px;" id="partyaccounttable"  tabindex="0">
          <thead>
              <tr>
                  <th width="75px">No</th>
                  <th>Party</th>
                  <th style="">Type</th>
                  <th style="">Balance</th>
              </tr>
          </thead>
          <tbody id="partytableBody">
            @foreach ($accs as $item)
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
                    
      <!-- Rate Modal -->
<div class="modal" id="rateModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select Rates</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
       <label style="width: 75px">F.S Rate</label>
        <input type="text" value="{{$datrate->open ?? 0}}" id="start_rate" style="width: 100px">
        <input type="text" value="{{$datrate->close ?? 0}}" id="end_rate" style="width: 100px">
        <input type="submit" value="NEW" class="btn btn-success" onclick="clearrate()"> <input type="submit" class="btn btn-success" value="SAVE / UPDATE" onclick="saverate()"> 
        <table class="table table-bordered table-striped" style="margin-top:10px;">
          <thead>
              <tr>
                  <th width="75px">No</th>
                  <th>Date</th>
                  <th>Rates</th>
              </tr>
          </thead>
          <tbody>
           
            @foreach ($ratz as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->date}}</td>
              <td>{{$item->open}}-{{$item->close}}</td>
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


  
      <!-- Search Modal -->
<div class="modal" id="searchModal">
  <div class="modal-dialog" style="min-width: 100%;
  margin: 0;
min-height: 100vh;">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select Rates</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
       <label style="width: 75px">Select Date</label>
        <input type="date" id="getdates" name="getdates" style="width: 100px" value="<?php echo $date=date("Y-m-d");?>">  <input type="submit"   onclick="getData()" value="Search">
        <table class="table table-bordered table-striped" style="margin-top:10px;">
          <thead>
              <tr>
                  <th width="5%">ID</th>
                  <th  width="5%">VAN</th>
                  <th  width="5%">Weight</th>
                  <th  width="15%">Former</th>
                  <th  width="5%">Rate</th>
                  <th  width="10%">Amount</th>
                  <th  width="15%">Purchaser</th>
                  <th  width="5%">Rate</th>
                  <th  width="10%">Amount</th>
                  <th  width="5%">Profit</th>
                  <th  width="10%">Edit</th>
              </tr>
          </thead>
          <tbody  id="ttbody3">
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
    <script type="text/javascript">
var invno="0";
var rows12 = document.getElementById("partyaccounttable").getElementsByTagName("tr");
for (var i = 0; i < rows12.length; i++) {
  rows12[i].addEventListener("click", function() {
    var cells = this.getElementsByTagName("td");
    var rowData = [];
    for (var j = 0; j < cells.length; j++) {
      if(partyType=="FARMS"){
        document.getElementById("partN").value=cells[1].textContent;
        document.getElementById("fid").value=cells[0].textContent;
        document.getElementById("partNBalance").value=cells[3].textContent;
      }
      if(partyType=="DEALERS"){
        document.getElementById("partP").value=cells[1].textContent;
        document.getElementById("purid").value=cells[0].textContent;
        document.getElementById("partPBalance").value=cells[3].textContent;

      }
      console.log(cells[1].textContent);
      rowData.push(cells[j].textContent);
    }
    // console.log("Clicked row data:", rowData);
    calcultedvalue();
    $('#myModal').modal('hide');
    $('.modal-backdrop').remove(); // Remove the modal backdrop
    
  });
}
    var partyType;
    $(document).ready(function(){
    $("#searchInputParty").on("keyup", function() {
    var value = $(this).val().trim().toLowerCase();
    var partyType = $("#searchTyping").find(':selected').text().trim().toLowerCase();

    $("#partytableBody tr").each(function() {
        var rowData = $(this).text().trim().toLowerCase();
        var matchesValue = rowData.indexOf(value) > -1;

        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().trim().toLowerCase();
        var matchesPartyType = partyType === "all" || partyTypeText === partyType;

        $(this).toggle(matchesValue && matchesPartyType);
    });
});

    
    
    
});
function calcultedvalue(){
  
  var former_balance = $("input[name=partNBalance]").val();
  console.log(former_balance);
  var total_weight = $("input[name=pweight]").val();
  var for_rate = $("input[name=formerrate]").val();
  var forTotal=total_weight*for_rate;
  var forTotalBalance=forTotal+parseFloat(former_balance);
  document.getElementById('formeramount').value=forTotal;
  document.getElementById('formernerbalance').value=forTotalBalance;
  var pur_balance = $("input[name=partPBalance]").val();
  var pur_rate = $("input[name=purchaserrate]").val();
  var purTotal=total_weight*pur_rate;
  var purTotalBalance=purTotal+parseFloat(pur_balance);
  document.getElementById('purchaseramount').value=purTotal;
  document.getElementById('purchasernetbalance').value=purTotalBalance;//formprofit
document.getElementById('formprofit').value=purTotal-forTotal;
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
     
     
    // var newparty=1;
    // $("#partytableBody tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    // });
    
//   }
//     function formerSelect(){
//     partyType="Former";
//     document.getElementById("searchTyping").value = "1";
//     console.log(partyType);
//      var newparty=partyType.trim().toLowerCase()
//     // var newparty=1;
//     $("#partytableBody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
//     });
//   }
function formerSelect() {
     document.getElementById("searchInputParty").value='';
    partyType = "FARMS";
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
    partyType="DEALERS";
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
       function clsdisco(){
            var upp=document.getElementById("uprice").value;
            var netpr=document.getElementById("netprice").value;
            var perage=netpr/upp;
            var perage1=100-(perage*100)
           // var percent=upd/100;
            //var percent_value=ups*percent;
            //var final_value=ups-percent_value;
// document.getElementById("disc11").value = Math.round(perage1);
var roundedPerage1 = perage1.toFixed(2);

document.getElementById("disc11").value = roundedPerage1;
        }
    function addnew(){
         var url = "{{ url('addproductfromsales') }}";
       var party = $("input[name=partN]").val();
       var phone = $("input[name=phone]").val();
       var address = $("input[name=adress]").val();
       $.ajax({
           url:url,
           method:'POST',
           data:{
                  party:party, 
                  phone:phone,
                  address:address,
                },
           success:function(response){
               
              if(response.success){
              //fetchstudent();
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
    }
        function print(){
            var pinv = $("input[name=inv]").val();
            var pdate = $("input[name=date]").val();
            var url = "{{ url('salesbillprint2?pinv=') }}"+pinv;
            var url1 = "{{ url('download-stock-vise') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{ pinv:pinv, },
    success:function(response){
    }});
$.ajax({
    url:url1,
           method:'GET',
    dataType:"json",
    data:{    },
    success:function(response){
    }});
window.open(url,'_blank');

}
function updateWholeSale(a){
  var pinv = $("input[name=inv]").val();
  var fid = $("input[name=fid]").val();
        var date = $("input[name=getdate]").val();
        var purid = $("input[name=purid]").val();
        var van = $("input[name=van]").val();
        var pweight = $("input[name=pweight]").val();
        var formerrate = $("input[name=formerrate]").val();
        var formeramount = $("input[name=formeramount]").val();
        var purchaserrate = $("input[name=purchaserrate]").val();
        var purchaseramount = $("input[name=purchaseramount]").val();
        
        var url = "{{ url('updateWholeSale') }}";
        $.ajax({
            url:url,
                   method:'GET',
            dataType:"json",
            data:{
              pinv:pinv,
                  fid:fid,
                  purid:purid,
                  date:date,
                  van:van,
                  weight:pweight,
                  formerrate:formerrate,
                  formeramount:formeramount,
                  purchaserrate:purchaserrate,
                  purchaseramount:purchaseramount,
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
        
        fetchstudent();
        document.getElementById("updateButton").disabled = true;
          document.getElementById("subs").disabled = false;
               } 
          function mtd(a){
            var result = confirm("Do You Want to delete?");
  if (result==true) {       
        
var url = "{{ url('deleteWholeSale') }}";
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
               
               fetchstudent();
                   //Message come from controller
                   location.reload();

              }else{
                  alert("Error")
              }

    }

});
} else {
    // alert("Thanks God You saved....");
  }

fetchstudent();
       } 
       function clearrate(){
        document.getElementById('start_rate').value="";    
        document.getElementById('end_rate').value="";  
       }

       function saverate(){   
        var strt=document.getElementById('start_rate').value;    
        var endt=document.getElementById('end_rate').value;  
var url = "{{ url('saverate') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        strt:strt,
        endt:endt,
                    },
    success:function(response){

      if(response.success){
              
                 alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }

    }

});

fetchstudent();
       }   





        var batch;
        var expiry;
        var batchunits;
        var rat;
        var pros;
        var ppt;
        var dix;
         function mts(a){//deleteButton
          document.getElementById("updateButton").disabled = false;
          document.getElementById("deleteButton").disabled = false;
          document.getElementById("subs").disabled = true;
         // var pinv = $("input[name=inv]").val();
          document.getElementById("inv").value=a;
          invno=a;
          var url = "{{ url('getSaleUpdate') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        a:a,
                    },
    success:function(response){
// console.log(response);
document.getElementById("fid").value=response.singleEntry.fid;
document.getElementById("partN").value=response.singleEntry.rbook.name;
document.getElementById("partNBalance").value=response.form_balance[0].blnc;
document.getElementById("van").value=response.singleEntry.van;
document.getElementById("pweight").value=response.singleEntry.weight;
document.getElementById("formerrate").value=response.singleEntry.frate;
document.getElementById("formeramount").value=response.singleEntry.famount;
document.getElementById("formernerbalance").value=parseFloat(response.form_balance[0].blnc)+parseFloat(response.singleEntry.famount);
document.getElementById("purid").value=response.singleEntry.pid;
document.getElementById("partP").value=response.singleEntry.pbook.name;
document.getElementById("partPBalance").value=response.pur_balance[0].blnc;
document.getElementById("purchaserrate").value=response.singleEntry.prate;
document.getElementById("purchaseramount").value=response.singleEntry.pamount;
document.getElementById("purchasernetbalance").value=parseFloat(response.pur_balance[0].blnc)+parseFloat(response.singleEntry.pamount);
      // if(response.success){
              
      //            alert(response.success)
               
               
      //              //Message come from controller

      //         }else{
      //             alert("Error")
      //         }

    }

});
//searchModal
 $('#searchModal').modal('hide');
    $('.modal-backdrop').remove();
       }
        function functionBill() {
  $value=document.getElementById("tot").value;
  $di=document.getElementById("disco").value;
  $cas=document.getElementById("cas").value;
$netprice=$value-$di;
  $nets=$netprice-$cas;
  $nets1=Math.round($nets*100)/100;
  document.getElementById("netcas").value=$nets1;
}
function getData(){
            var url = "{{ url('fetchstudent1') }}";
            var inv = $("input[name=getdates]").val();
          console.log(inv); 
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:inv,
                },
    success:function(response){
        var ids=1;
        var bodyData3 = '';
console.log(response.var);
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
        $.each(response.var,function(key,item){
            $("#ttbody3").html(""); 
     bodyData3+="<tr>"
                    bodyData3+="<td>"+ids+"</td><td>"+item.van+"</td><td>"+item.weight+"</td><td>"+item.rbook.name+"</td><td>"+item.frate+"</td><td>"+item.famount+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.profit+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mts("+item.id+")'><i class='fa fa-recycle'></i> Update</a></td>";
                    
                    bodyData3+="</tr>";
                    ids=ids+1;
                    table_weight=table_weight+parseFloat(item.weight);
                    table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.profit);
        })
        bodyData3+="<td></td><td></td><td>"+table_weight+"</td><td></td><td></td><td>"+table_former_amount+"</td><td></td><td></td><td>"+table_purchaser_amount+"</td><td>"+table_profit_amount+"</td><td></td>";
        var sa=0;
        var dis=0;
        // console.log(response.sbook);
        $("#ttbody3").append(bodyData3);
    }

});

        }




function fetchstudent(){
            var url = "{{ url('fetch-student') }}";
            var inv = $("input[name=inv]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    success:function(response){
        var ids=1;
        var bodyData = '';
        var bodyData1 = '';
        
        
     //   console.log(response.var);
         var myLink = document.getElementById("linkx");
var currentHref = myLink.getAttribute("href");
    // Update the text content
   var newHref = currentHref + "Dear Customer Your Bill is= "+response.pros+"\n and Discount values is "+response.disc+" Bill No is"+inv;
    myLink.setAttribute("href", newHref);

console.log(response.var);
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
        $.each(response.var,function(key,item){
            $("#ttbody").html("");
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.van+"</td><td>"+item.weight+"</td><td>"+item.rbook.name+"</td><td>"+item.frate+"</td><td>"+item.famount+"</td><td>"+item.pbook.name+"</td>";
                    // <td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.profit+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    table_weight=table_weight+parseFloat(item.weight);
                    table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.profit);
        })
        bodyData+="<td></td><td></td><td>"+table_weight+"</td><td></td><td></td><td>"+table_former_amount+"</td>";
        // <td></td><td></td><td>"+table_purchaser_amount+"</td><td>"+table_profit_amount+"</td>";
        $("#ttbody").append(bodyData);
        bodyData = '';
        $.each(response.var,function(key,item){
            $("#ttbody3").html("");
     bodyData+="<tr>"
     //<a  value='"+item.id+"' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a><br/>
                    bodyData+="<td>"+ids+"</td><td>"+item.van+"</td><td>"+item.weight+"</td><td>"+item.rbook.name+"</td><td>"+item.frate+"</td><td>"+item.famount+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.profit+"</td><td><a  value='"+item.id+"' href='#' onclick='mts("+item.id+")'><i class='fa fa-recycle'></i> Update</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    // table_weight=table_weight+parseFloat(item.weight);
                    // table_former_amount=table_former_amount+parseFloat(item.famount);
                    // table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    // table_profit_amount=table_profit_amount+parseFloat(item.profit);
        })
        bodyData+="<td></td><td></td><td>"+table_weight+"</td><td></td><td></td><td>"+table_former_amount+"</td><td></td><td></td><td>"+table_purchaser_amount+"</td><td>"+table_profit_amount+"</td><td></td>";
     
        var sa=0;
        var dis=0;
        console.log(response.sbook);
        
        $("#ttbody3").append(bodyData);
    }

});

        }
       $(function () {
         
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

        var route = "{{ url('autocomplete-search') }}";
       

        $('#search1').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
       
     
        fetchstudent();
    $("#subs").click(function(e){

        e.preventDefault();
        var fid = $("input[name=fid]").val();
        var date = $("input[name=getdate]").val();
        var purid = $("input[name=purid]").val();
        var van = $("input[name=van]").val();
        var pweight = $("input[name=pweight]").val();
        var formerrate = $("input[name=formerrate]").val();
        var formeramount = $("input[name=formeramount]").val();
        var purchaserrate = $("input[name=purchaserrate]").val();
        var purchaseramount = $("input[name=purchaseramount]").val();//formernetbalance
        var formerblnc = $("input[name=formernetbalance]").val();
// var search=$("#thik").find(':selected').val();
//        // var search = $("input[name=search]").val();
//         var units = $("input[name=units]").val();
//         var uprice = $("input[name=uprice]").val();
//         var inv = $("input[name=inv]").val();
//         var date = $("input[name=date]").val();
//          var party = $("input[name=partN]").val();
//          var avail = $("input[name=sstk]").val();
//          var disc11=$("input[name=disc11]").val();

        //var town='document.getElementById("town").innerHTML';
        //var booker=document.getElementById("booker").value;
        var url = "{{ url('calcu') }}";
       // alert(inv);
       // alert(party);
       if(purid==''){
           alert("Please set Farms");
           return;
       }
       if(fid==''){
           alert("Please set Dealer");
           return;
       }
       if(van==''){
           alert("Add Van");
           return;
       }
       if(pweight==''){
           alert("Add Weight");
           return;
       }
        
     //  if(units>avail){
//alert("out of stock");
//}else{
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  fid:fid,
                  purid:purid,
                  date:date,
                  van:van,
                  weight:pweight,
                  formerrate:formerrate,
                  formeramount:formeramount,
                  purchaserrate:purchaserrate,
                  purchaseramount:purchaseramount,
                },
           success:function(response){
               
              if(response.success){
              fetchstudent();
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
   
   //}
        var fid = $("input[name=fid]").val();
        var date = $("input[name=getdate]").val();
        var purid = $("input[name=purid]").val();
        var van = $("input[name=van]").val();
        var pweight = $("input[name=pweight]").val();
        var formerrate = $("input[name=formerrate]").val();
        var formeramount = $("input[name=formeramount]").val();
        var purchaserrate = $("input[name=purchaserrate]").val();
        var purchaseramount = $("input[name=purchaseramount]").val();
    //document.getElementById("search").value='';partPBalance//partNBalance
    document.getElementById("partNBalance").value=formerblnc;
    document.getElementById("partP").value='';
    document.getElementById("purid").value='';
    document.getElementById("pweight").value='';
    document.getElementById("purchaserrate").value='';
    document.getElementById("purchaseramount").value=''; //purchasernetbalance
    document.getElementById("purchasernetbalance").value='';//formerrate
    document.getElementById("partPBalance").value='';
    document.getElementById("formerrate").value='';
        //  document.getElementById("units").value='';formeramount//formernerbalance
         document.getElementById("formeramount").value='';
          document.getElementById("formernerbalance").value='';
         document.getElementById("van").value='';
         document.getElementById("disc11").value='0';
         document.getElementById("van").focus();
   fetchstudent();
   
   
	});
   }); 

$(document).ready(function() {
    $('#myModal').on('shown.bs.modal', function () {
        $('#searchInputParty').focus();
    });
});
    </script>

    



<script>
$(document).ready(function() {
    let $rows = $('#partyaccounttable tbody tr');
    let visibleRows = $rows;
    let selectedIndex = -1;
    let focusOnTable = false;

    $(document).on('keydown', function(e) {
        if (focusOnTable) {
            if (e.key === 'ArrowDown') {
                moveSelection('down');
                e.preventDefault();
            } else if (e.key === 'ArrowUp') {
                moveSelection('up');
                e.preventDefault();
            } else if (e.key === 'Enter') {
                if (selectedIndex > -1) {
                    const $selectedRow = visibleRows.eq(selectedIndex);
                    const rowData = {
                        no: $selectedRow.find('td').eq(0).text(),
                        party: $selectedRow.find('td').eq(1).text(),
                        type: $selectedRow.find('td').eq(2).text(),
                        balance: $selectedRow.find('td').eq(3).text()
                    };
                    // console.log(rowData); // Replace this with your own handling of the selected row data
                    // alert('Selected Row Data: ' + JSON.stringify(rowData));
                }
                e.preventDefault();
            }
        } else {
            if (e.key === 'Tab' && e.target.id === 'searchTyping') {
                focusOnTable = true;
                if (selectedIndex < 0) selectedIndex = 0;
                updateSelection();
                e.preventDefault();
            }
        }
    });

    function moveSelection(direction) {
        let newIndex = selectedIndex;
        if (direction === 'down') {
            newIndex = Math.min(selectedIndex + 1, visibleRows.length - 1);
        } else if (direction === 'up') {
            newIndex = Math.max(selectedIndex - 1, 0);
        }

        if (newIndex !== selectedIndex) {
            selectedIndex = newIndex;
            updateSelection();
        }
    }

    function updateSelection() {
        $rows.removeClass('highlight');
        if (selectedIndex > -1) {
            visibleRows.eq(selectedIndex).addClass('highlight');
            const $selectedRow = visibleRows.eq(selectedIndex);
            const tableTop = $('#partyaccounttable').offset().top;
            const rowTop = $selectedRow.offset().top;
            const tableHeight = $('#partyaccounttable').height();
            const rowHeight = $selectedRow.outerHeight();

            if (rowTop < tableTop || rowTop + rowHeight > tableTop + tableHeight) {
                $('#partyaccounttable').scrollTop($('#partyaccounttable').scrollTop() + $selectedRow.position().top - $('#partyaccounttable').height()/2);
            }
        }
    }

    $('#searchTyping').on('change', function() {
        const newparty = $(this).find('option:selected').text().toLowerCase();
        filterTable(newparty);
    });

    const filterTable = function(newparty) {
        $("#partytableBody tr").each(function() {
            const partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
            const match = partyTypeText === newparty;
            $(this).toggle(match);
        });

        // Update visible rows after filtering
        visibleRows = $('#partyaccounttable tbody tr:visible');

        // If there are visible rows, maintain the current selection or set it to the first visible row
        if (visibleRows.length > 0) {
            selectedIndex = Math.min(selectedIndex, visibleRows.length - 1);
            if (selectedIndex < 0) {
                selectedIndex = 0;
            }
            updateSelection();
        } else {
            selectedIndex = -1;
        }
    };
});
</script>
@endsection