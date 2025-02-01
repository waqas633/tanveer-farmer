@extends('layout')
@section('container')

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>

   
<div class="container">
    
    <h1 align="center">BHAGTANWALA POULTRY TRADERS</h1>

  
    
        
     
         <div class="row">
    <div>


      <label style="width:80px;text-align: left;display: none">Invoice No:</label><input type="text" value="1" disabled name="inv"  style="width: 150px;display: none" id="inv" placeholder="Enter Invoice Number"><br/>


      <label style="width:80px;text-align: left;">Date</label><input type="date" name="getdate" id="getdate" style="width: 150px;"  value="<?php echo $date=date("Y-m-d");?>"> <button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#searchModal"  onclick="getData()">Get Data</button>
      <label style="width:80px;text-align: left;">Rates</label><input type="text" name="rating" id="rating" style="width: 150px;" disabled  value="{{$datrate->open ?? 0}}-{{$datrate->close ?? 0}}"><button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#rateModal">Add Rate</button><br>

      <label style="margin-left:10px; ">Purchaser</label><input type="text" id="purid"  style="width: 30px;margin-left:10px;display: none" name="purid"><input type="text" id="partP" name="partP" style="width: 250px; " disabled> <button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#myModal" id="purchaserName" onclick="purchaseSelect()">PURCHASER</button> <label style="margin-left:10px; ">Balance</label><input type="text" style="margin-left:10px;width: 100px; " disabled name="partPBalance" id="partPBalance"><label style="margin-left:10px; ">Rate</label><input type="text"  onkeyup="calcultedvalue()" id="purchaserrate" name="purchaserrate" style="margin-left:10px;width: 100px; " value="{{$datrate->close ?? 0}}"><br/>
      <label style="margin-left:10px; display: none;">Amount</label><input type="text" disabled style="margin-left:10px;display: none " id="purchaseramount" name="purchaseramount"><label style="margin-left:10px;display: none ">Net Balance</label><input type="text" disabled style="margin-left:10px;display: none; " id="purchasernetbalance" name="purchasernetbalance">
      <table class="table table-bordered table-striped" >
        <thead>
          <tr>
              <th width="3%">ID</th>
              <th  width="5%">VAN</th>
              <th  width="5%">Weight</th>
              <th  width="17%">Purchaser</th>
              <th  width="5%">Rate</th>
              <th  width="10%">Amount</th>
              <th  width="10%">Profit</th>
          </tr>
      </thead>
          <tbody id="ttbodyz">
          </tbody>
      </table>

<label style="width:80px;text-align: left;">Party Name</label><input type="text" style="width: 30px;display: none;" id="fid" name="fid"><input type="text" name="partN" id="partN" style="margin-top: 3px;width: 250px;" value=""   disabled><button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" id="partyName"  onclick="formerSelect()" data-target="#myModal">FORMER</button> <label style="margin-left:10px; ">Balance</label><input type="text" name="partNBalance" id="partNBalance" disabled style="margin-left:10px; "><br/>
<label style="margin-left:10px; ">Weight</label><input type="number" id="pweight" name="pweight" style="margin-left:15px;  width:90px;" onkeyup="calcultedvalue()" onclick="calcultedvalue()"><label style="margin-left:10px; ">Rate</label><input type="number"  onkeyup="calcultedvalue()" id="formerrate" name="formerrate" style="margin-left:10px;  width:50px;" value="{{$datrate->open ?? 0}}"><label style="margin-left:10px; ">Amount</label><input type="text" disabled style="margin-left:10px; " id="formeramount" name="formeramount"><label style="margin-left:10px; ">Net Balance</label><input type="text" disabled style="margin-left:10px; " name="formernetbalance" id=formernerbalance><br/>
<label style="width: 120px; margin-left:10px;">Amount Received</label><input type="number" style="width:100px;" id="recamount" name="recamount" onkeyup="closingvalue()" onclick="closingvalue()"><label style="margin-left:10px; ">Closing Balance</label><input type="text" name="partNetBalance" id="partNetBalance" disabled style="margin-left:10px; ">

<br>
<div style="margin-left: 70px;position: relative;display: -webkit-inline-box;display: -ms-inline-flexbox;display: inline-flex;vertical-align: middle;padding:20px;">
<button class="btn mb-2 mb-md-0 btn-primary"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">New</button><button class="btn btn-success"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" name="subs" id="subs"    onsubmit = "fetchstudent()" >Save</button><button class="btn btn-success" onclick="updateWholeSale()" id="updateButton" disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Update</button><button class="btn btn-danger"  disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Delete</button>
<button class="btn btn-danger"  disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Delete</button>
<button class="btn btn-danger"  onclick="location.href='/welcome';"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Main Menu</button>
</div>







        
   
</div>

</div>




    



  
    <table class="table table-bordered table-striped" >
      <thead>
        <tr>
            <th width="3%">ID</th>
            <th width="12%">Date</th>
            <th  width="15%">VAN</th>
            <th  width="5%">Weight</th>
            <th  width="17%">Former</th>
            <th  width="5%">Rate</th>
            <th  width="10%">Amount</th>
            <th  width="10%">Receiving</th>
            <th  width="5%">Balance</th>
            <th  width="10%">Edit</th>
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
        <input type="date" style="width: 100px">  <input type="submit" value="Search">
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
var wts=0;
var wtprice=0;
var purchaserate=0;
var rows12 = document.getElementById("partyaccounttable").getElementsByTagName("tr");
for (var i = 0; i < rows12.length; i++) {
  rows12[i].addEventListener("click", function() {
    var cells = this.getElementsByTagName("td");
    var rowData = [];
    for (var j = 0; j < cells.length; j++) {
      if(partyType=="Former"){
        document.getElementById("partN").value=cells[1].textContent;
        document.getElementById("fid").value=cells[0].textContent;
        document.getElementById("partNBalance").value=cells[3].textContent;
      }
      if(partyType=="Purchaser"){
        document.getElementById("partP").value=cells[1].textContent;
        document.getElementById("purid").value=cells[0].textContent;
        document.getElementById("partPBalance").value=cells[3].textContent;
        //wholesaless
        var ids=1;
        var bodyData3 = '';
//console.log($wholesaless);
var dataArray = {!! json_encode($wholesaless) !!}; // Assuming $dataArray contains your provided array
            
            // Filter data based on the 'fid' column
            var filteredData = dataArray.filter(function(item) {
                // Change '14' to the fid value you want to filter by
                return item.pid == cells[0].textContent; // Change 14 to your actual filter criteria
            });
            $("#ttbodyz").html(""); 
            console.log(filteredData);
            var table_weight=0;
            wts=0;
            wtprice=0;
            purchaserate=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
            $.each(filteredData,function(key,item){
           
     bodyData3+="<tr>"
                    bodyData3+="<td>"+ids+"</td><td>"+item.van+"</td><td>"+item.weight+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.profit+"</td>";
                    
                    bodyData3+="</tr>";
                    ids=ids+1;
                    purchaserate=parseFloat(item.prate);
                    table_weight=table_weight+parseFloat(item.weight);
                    wts=wts+parseFloat(item.weight);
                    table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    wtprice=wtprice+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.profit);
        })
        bodyData3+="<td></td><td></td><td>"+table_weight+"</td><td></td><td></td><td>"+table_purchaser_amount+"</td><td>"+table_profit_amount+"</td>";
        var sa=0;
        var dis=0;
        // console.log(response.sbook);
        $("#ttbodyz").append(bodyData3);




        //     addDataToTable(filteredData);
        //     function addDataToTable(data) {
        //     var tableBody = document.getElementById("ttbodyz");
        //     // for (var i = 0; i < data.length; i++) {
        //     //     var row = tableBody.insertRow();
        //     //     for (var key in data[i]) {
        //     //         var cell = row.insertCell();
        //     //         cell.innerHTML = data[i][key];
        //     //     }
        //     // }
        // }

  

      }
      console.log(cells[0].textContent);
      rowData.push(cells[j].textContent);
    }
    console.log("Clicked row data:", rowData);
    calcultedvalue();
    $('#myModal').modal('hide');
    $('.modal-backdrop').remove(); // Remove the modal backdrop
    
  });
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
function closingvalue(){
  var former_balance = $("input[name=formernetbalance]").val();
  var recovery_amount = $("input[name=recamount]").val();
  var purTotalBalance=parseFloat(former_balance)-parseFloat(recovery_amount);
  document.getElementById('partNetBalance').value=purTotalBalance;
}
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
  document.getElementById('purchasernetbalance').value=purTotalBalance;
  closingvalue();

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
        var van = $("input[name=purid]").val();
        var pweight = $("input[name=pweight]").val();
        var formerrate = $("input[name=formerrate]").val();
        var formeramount = $("input[name=formeramount]").val();
        var recovery_amount = $("input[name=recamount]").val();
        var former_open = $("input[name=partNBalance]").val();
        var former_close = $("input[name=partNetBalance]").val();
        
        var url = "{{ url('updateLocalSale') }}";
        $.ajax({
            url:url,
                   method:'GET',
            dataType:"json",
            data:{
              pinv:pinv,
              date:date,
        purid:fid,
        van:van,
        total_weight:wts,
        weight_amount:wtprice,
        pweight:pweight,
        formerrate:formerrate,
        formeramount:formeramount,
        recovery_amount:recovery_amount,
        former_open:former_open,
        former_close:former_close,
        purchaserrate:purchaserate,
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
        document.getElementById("updateButton").disabled = true;
          document.getElementById("subs").disabled = false;
               } 
          function mtd(a){
            var result = confirm("Do You Want to delete?");
  if (result==true) {       
        
var url = "{{ url('deleteLocalSale') }}";
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
               
               
                   //Message come from controller

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
         function mts(a){
          document.getElementById("updateButton").disabled = false;
          document.getElementById("subs").disabled = true;
         // var pinv = $("input[name=inv]").val();
          document.getElementById("inv").value=a;
          var url = "{{ url('getLocalSaleUpdate') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        a:a,
                    },
    success:function(response){
console.log(response);
document.getElementById("inv").value=response.singleEntry.id;
document.getElementById("partP").value=response.singleEntry.rbook.name;
document.getElementById("partPBalance").value=response.form_balance[0].blnc;
document.getElementById("purid").value=response.singleEntry.van;
document.getElementById("partN").value=response.singleEntry.pbook.name;
document.getElementById("partNBalance").value=response.singleEntry.Open;
document.getElementById("pweight").value=response.singleEntry.weight;
document.getElementById("formerrate").value=response.singleEntry.prate;
document.getElementById("formeramount").value=response.singleEntry.pamount;
document.getElementById("partNetBalance").value=response.singleEntry.Close;
document.getElementById("recamount").value=response.singleEntry.recivings;
document.getElementById("fid").value=response.singleEntry.purchaser;
document.getElementById("purchaserrate").value=response.singleEntry.prate;
document.getElementById("purchaseramount").value=response.singleEntry.pamount;
document.getElementById("formernerbalance").value=parseFloat(response.singleEntry.Open)+parseFloat(response.singleEntry.pamount);
// document.getElementById("purchasernetbalance").value=parseFloat(response.pur_balance[0].blnc)+parseFloat(response.singleEntry.pamount);
      // if(response.success){
              
      //            alert(response.success)
               
               
      //              //Message come from controller

      //         }else{
      //             alert("Error")
      //         }

    }

});
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
            var url = "{{ url('fetch-student1') }}";
            var inv = $("input[name=getdate]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:inv,
                },
    success:function(response){
        var ids=1;
console.log(response.var);
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
var bodyData3 = '';
        $.each(response.var,function(key,item){
            $("#ttbody3").html(""); 
     bodyData3+="<tr>"
                    bodyData3+="<td>"+ids+"</td><td>"+item.van+"</td><td>"+item.weight+"</td><td>"+item.rbook.name+"</td><td>"+item.frate+"</td><td>"+item.famount+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.profit+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData3+="</tr>";
                    ids=ids+1;
                    table_weight=table_weight+parseFloat(item.weight);
                    table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.profit);
        })
        bodyData3+="<td></td><td></td><td>"+table_weight+"</td><td></td><td>"+table_former_amount+"</td><td></td><td>"+table_purchaser_amount+"</td><td>"+table_profit_amount+"</td><td></td>";
        var sa=0;
        var dis=0;
        console.log(response.sbook);
        $("#ttbody3").append(bodyData3);
    }

});

        }




function fetchstudent(){
            var url = "{{ url('fetchstudent1') }}";
            var inv = $("input[name=inv]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    success:function(response){
        var ids=1;
        var bodyData = '';
        var bodyData1 = '';
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
        $.each(response.var,function(key,item){
            $("#ttbody").html(""); 
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.rbook.name+"</td><td>"+item.weight+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.recivings+"</td><td>"+item.Close+"</td><td><a  value='"+item.id+"' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a><br/><a  value='"+item.id+"' href='#' onclick='mts("+item.id+")'><i class='fa fa-recycle'></i> Update</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    table_weight=table_weight+parseFloat(item.weight);
                    // table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.recivings);
        })
        bodyData+="<td></td><td></td><td><b>Total</b></td><td><b>"+table_weight+"</b></td><td></td><td></td><td><b>"+table_purchaser_amount+"</b></td><td><b>"+table_profit_amount+"</b></td><td></td>";
        var sa=0;
        var dis=0;
        console.log(response.sbook);
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
        var van = $("input[name=purid]").val();
        var pweight = $("input[name=pweight]").val();
        var formerrate = $("input[name=formerrate]").val();
        var formeramount = $("input[name=formeramount]").val();
        var recovery_amount = $("input[name=recamount]").val();
        var former_open = $("input[name=partNBalance]").val();
        var former_close = $("input[name=partNetBalance]").val();
        var url = "{{ url('add_localsales') }}";
       if(formerrate==''){
           alert("Please set rate");
           return;
       }
       if(fid==''){
           alert("Please set Former");
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
      //  console.log(url);
//       var wts=0;
// var wtprice=0;
// var purchaserate=0;
        $.ajax({
           url:url,
           method:'GET',
           data:{
        date:date,
        purid:fid,
        van:van,
        total_weight:wts,
        weight_amount:wtprice,
        pweight:pweight,
        formerrate:formerrate,
        formeramount:formeramount,
        recovery_amount:recovery_amount,
        former_open:former_open,
        former_close:former_close,
        purchaserrate:purchaserate,
                },
           success:function(response){
               
              if(response.success){
              fetchstudent();
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
   fetchstudent();
   
	});
   }); 
$(document).ready(function() {
    $('#myModal').on('shown.bs.modal', function () {
        $('#searchInputParty').focus();
    });
});

    </script>
@endsection