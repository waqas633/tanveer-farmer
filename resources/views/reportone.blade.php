@extends('layout')
@section('container')
<div align="center">
<h1>Customer Ledger</h1>
<p>Select Dates</p>
<form      onsubmit="return false">
	Enter Name: <input type="text" id="cname" name="cname"> <button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" id="partyName"  onclick="formerSelect()" data-target="#myModal">FORMER</button>
	Start Date: <input type="date" id="date1" name="cname"  value="<?php echo date('Y-m-d'); ?>">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data"  onclick="fetchstudent()">
	<a href="#"   onclick="fetchprint()">Print</a> 
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">Rate</th>
                <th width="100px">Date</th>
                              <th width="75px">CR</th>
              <th width="75px">DR</th>
              <th width="75px">Balance</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
    <span style="float: right; text-align: right;">
        
    <label style="font-size: 20px;">Cash Received:  </label><label id="tsr" style="font-size: 20px;">0</label><br>
    <label style="font-size: 20px;">Cash Payments:  </label><label id="tsp" style="font-size: 20px;">0</label><br>
<label style="font-size: 20px;">Closing Balance:  </label><label id="ts" style="font-size: 20px;">0</label></span>
</div>
</form>

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
            var blncs=0;
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
          blncs+=item.cr-item.dr;
          var typx="";
          if(blncs<0){
typx="DR";
          }else{
            typx="CR";
          }
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td></td><td>"+item.date+"</td><td>"+item.cr+"</td><td>"+item.dr+"</td><td>"+blncs+" "+typx+"</td>";
                    
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
//     $(document).ready(function(){
//   $("#searchInputParty").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#partytableBody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
//   });
});
function changeSelect(){
// partyType2=$("#searchTyping").find(':selected').text();
//     console.log(partyType2);
//      var newparty=partyType2.toLowerCase()
//     // var newparty=1;
//     $("#partytableBody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
//     });
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
// function formerSelect(){
//     partyType="Former";
//     document.getElementById("searchTyping").value = "1";
//     console.log(partyType);
//      var newparty=partyType.toLowerCase()
//     // var newparty=1;
//     $("#partytableBody tr").filter(function() {
//       $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
//     });
//   }
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
var rows12 = document.getElementById("partyaccounttable").getElementsByTagName("tr");
for (var i = 0; i < rows12.length; i++) {
  rows12[i].addEventListener("click", function() {
    var cells = this.getElementsByTagName("td");
    var rowData = [];
    for (var j = 0; j < cells.length; j++) {
      if(partyType=="Former"){
        document.getElementById("cname").value=cells[1].textContent;
      }
      if(partyType=="Purchaser"){
        document.getElementById("cname").value=cells[1].textContent;

      }
      console.log(cells[1].textContent);
    }
    $('#myModal').modal('hide');
    $('.modal-backdrop').remove(); // Remove the modal backdrop
    
  });
}
                    </script>
@endsection