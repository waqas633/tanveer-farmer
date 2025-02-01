@extends('layout')
@section('container')
<div class="row">
<div>
	

	
	<h1 align="center">Add New Account</h1>

<table>
	<tr>
		<td>Customer Type:</td>
		<td>
			<select name="itemType" id="itemType" style="width:178px;">
				@foreach($acc_type as $types)
				<option value="{{$types->type}}">{{$types->type}}</option>
				@endforeach
			</select>
		</td>
		
		<td><button style="margin-left:10px; "  class="btn btn-success"  data-toggle="modal" data-target="#myModal" id="purchaserName" onclick="purchaseSelect()">GET DATA</button></td>
	<td><input type="text" id="pinv" name="pinv" readonly disabled> </td>
	</tr>
	<tr>
		<td>Customer Name</td>
		<td colspan="3"><input type="text" style="width: 583px" name="itemName" id="itemName" placeholder="Enter Customer Name"></td>
	</tr>
	<tr>
		<td>Enter Phone Number:</td>
		<td><input type="text" name="phone" id="phone"></td>
		<td>Enter Phone Number:</td>
		<td><input type="text" name="phone1" id="phone1"></td>
	</tr>
	<tr>
		<td>Enter Phone Number:</td>
		<td><input type="text" name="phone2" id="phone2"></td>
		<td>Enter Phone Number:</td>
		<td><input type="text" name="phone3"- id="phone3"></td>
	</tr>
	<tr>
		<td>Opening Balace</td>
		<td><input type="text" name="oblc" id="oblc"></td>
		<td>Account Type</td>
		<td><input type="radio" name="type" id="dre">Debit<input type="radio" name="type" id="cre">Credit</td>
	</tr>
	<tr>
		<td>Account</td>
		<td colspan="3"><input type="text" id="acc11"  style="width: 583px"></td>
		
	</tr>
	<tr>
	    <td>Account</td>
		<td colspan="3"><input type="text" id="acc21"  style="width: 583px"></td>
	</tr>
	<tr>
		<td>Personal Address</td>
		<td colspan="3"><textarea cols="80" role="6" id="addressarea"></textarea></td>
	</tr>
	<tr>
		<td>Farm Address</td>
		<td colspan="3"><textarea cols="80" role="6" id="addressarea1"></textarea></td>
	</tr>
</table>
 <div style="margin-left: 210px;position: relative;display: -webkit-inline-box;display: -ms-inline-flexbox;display: inline-flex;vertical-align: middle;padding:20px;">
<a  class="btn mb-2 mb-md-0 btn-primary"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" href="customer">New</a>
<button class="btn btn-success"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;" name="subs" id="subs"    onsubmit = "fetchstudent()">Save</button><button class="btn btn-success" id="updateButton" disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Update</button>
<button class="btn btn-danger"  disabled  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Delete</button>
<button class="btn btn-danger"  onclick="location.href='/welcome';"  style="margin-left:10px;border-radius: 0 40px 0 38px;padding: 12px 20px;">Main Menu</button>
</div>
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
					<th style="">Cr</th>
					<th style="">Dr</th>
				</tr>
			</thead>
			<tbody id="partytableBody">
			  @foreach ($accs as $item)
			  <tr>
				<td>{{$item->book->id ??0}}</td>
				<td>{{$item->book->name  ??0}}</td>
				<td>{{$item->book->type ??0}}</td>
				<td>{{$item->cr}}</td>
				<td>{{$item->dr}}</td>
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
<script>
var partyType;
var rows = document.getElementById("partyaccounttable").getElementsByTagName("tr");

for (var i = 0; i < rows.length; i++) {
  rows[i].addEventListener("click", handleRowSelection);
  rows[i].addEventListener("keydown", function(e) {
    if (e.key === "Enter") {
      handleRowSelection.call(this);
    }
  });
}

function handleRowSelection() {
  var cells = this.getElementsByTagName("td");
  var rowData = [];
  for (var j = 0; j < cells.length; j++) {
    rowData.push(cells[j].textContent);
  }
  
  document.getElementById("itemName").value = rowData[1];
  
  if (rowData[3] != 0) {
    $('#cre').prop('checked', true);
    $('#dre').prop('checked', false);
    document.getElementById("oblc").value = rowData[3];
  } 
  if (rowData[4] != 0) {
    $('#dre').prop('checked', true);
    $('#cre').prop('checked', false);
    document.getElementById("oblc").value = rowData[4];
  }

  var dataArray = {!! json_encode($bookz) !!};
  var filteredData = dataArray.filter(function(item) {
    return item.id == rowData[0];
  });

  document.getElementById("updateButton").disabled = false;
  document.getElementById("subs").disabled = true;
  document.getElementById("pinv").value = filteredData[0].id;
  document.getElementById("phone").value = filteredData[0].phone;
  document.getElementById("phone1").value = filteredData[0].phone1;
  document.getElementById("phone2").value = filteredData[0].ntn;
  document.getElementById("phone3").value = filteredData[0].pmdc;
  document.getElementById("addressarea").value = filteredData[0].address;
  document.getElementById("addressarea1").value = filteredData[0].address1;
  document.getElementById("acc11").value = filteredData[0].acc;
  document.getElementById("acc21").value = filteredData[0].acc1;
  document.getElementById("itemType").value = filteredData[0].type;

 $('#myModal').modal('hide');
$('body').removeClass('modal-open');
$('.modal-backdrop').remove();
}

// 	var partyType;
	//table click
// 	var rows12 = document.getElementById("partyaccounttable").getElementsByTagName("tr");
// for (var i = 0; i < rows12.length; i++) {
//   rows12[i].addEventListener("click", function() {
//     var cells = this.getElementsByTagName("td");
//     var rowData = [];
//     for (var j = 0; j < cells.length; j++) {
//       rowData.push(cells[j].textContent);
//     }
// 	document.getElementById("itemName").value=rowData[1];
// 	if (rowData[3] != 0) {
//     $('#cre').prop('checked', true);
//     $('#dre').prop('checked', false); // Uncheck the other checkbox
// 	document.getElementById("oblc").value=rowData[3];
// }if (rowData[4] != 0) {
//     $('#dre').prop('checked', true);
//     $('#cre').prop('checked', false); // Uncheck the other checkbox
// 	document.getElementById("oblc").value=rowData[4];
// }
// var dataArray = {!! json_encode($bookz) !!}; // Assuming $dataArray contains your provided array
            
//             // Filter data based on the 'fid' column
//             var filteredData = dataArray.filter(function(item) {
//                 // Change '14' to the fid value you want to filter by
//                 return item.id == rowData[0]; // Change 14 to your actual filter criteria
//             });
//     console.log("Clicked row data:", rowData[1]);
// 	document.getElementById("updateButton").disabled = false;
//           document.getElementById("subs").disabled = true;
// 	document.getElementById("pinv").value=filteredData[0].id;
// 	document.getElementById("phone").value=filteredData[0].phone;
// 	document.getElementById("phone1").value=filteredData[0].phone1;
// 	document.getElementById("phone2").value=filteredData[0].ntn;
// 	document.getElementById("phone3").value=filteredData[0].pmdc;
// 	document.getElementById("addressarea").value=filteredData[0].address;
// 	document.getElementById("addressarea1").value=filteredData[0].address1;

// 	console.log(filteredData);
// // 	let str = filteredData[0].acc;
// // let parts = str.split("-");
// document.getElementById("acc11").value=filteredData[0].acc;
// // document.getElementById("acc12").value=parts[1];
// // document.getElementById("acc13").value=parts[2];
// // let str1 = filteredData[0].acc1;
// // let parts1 = str1.split("-");
// document.getElementById("acc21").value=filteredData[0].acc1;
// // document.getElementById("acc22").value=parts1[1];
// // document.getElementById("acc23").value=parts1[2];
// document.getElementById("itemType").value=filteredData[0].type;
// // setOptionSelectedById("itemType", filteredData[0].type);
//     // calcultedvalue();
//     $('#myModal').modal('hide');
//     $('.modal-backdrop').remove(); // Remove the modal backdrop
    
//   });
// }
	//table click end
	function purchaseSelect(){
    partyType="Former";
    // document.getElementById("searchTyping").value = "1";
    // console.log(partyType);
    // var newparty=partyType.toLowerCase()
    // $("#partytableBody tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    // });
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
  function changeSelect(){
partyType=$("#searchTyping").find(':selected').text();
    console.log(partyType);
    //  var newparty=partyType.toLowerCase()
    // // var newparty=1;
    // $("#partytableBody tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(newparty) > -1)
    // });
         var newparty=partyType.toLowerCase()
      $("#partytableBody tr").filter(function() {
        // Get the text of the specific column (index 2 for third column)
        var partyTypeText = $(this).find('td').eq(2).text().toLowerCase();
        var match = partyTypeText === newparty;
        $(this).toggle(match);
    });
  }
  $("#subs").click(function(e){

e.preventDefault();
var itemName=document.getElementById("itemName").value;
var balance=document.getElementById("oblc").value;
var phone=document.getElementById("phone").value;
var phone1=document.getElementById("phone1").value;
var phone2=document.getElementById("phone2").value;
var phone3=document.getElementById("phone3").value;
var address=document.getElementById("addressarea").value;
var address1=document.getElementById("addressarea1").value;
var ace11=document.getElementById("acc11").value;
var account1=ace11;
var ace21=document.getElementById("acc21").value;
var account2=ace21;
var acctype=document.getElementById("itemType").value;
var type="";
      if(document.getElementById('cre').checked == true) {   
         type="cr" ; 
}
if(document.getElementById('dre').checked == true) {   
         type="dr" ; 
} 
var url = "{{ url('addcustomers') }}";
if(itemName==''){
   alert("Please Enter Name");
   return;
}
if(phone==''){
   alert("Please Enter Phone");
   return;
}
if(phone1==''){
   alert("Please Enter Phone 2");
   return;
}
if(address==''){
   alert("Please Enter Address");
   return;
}
if(balance==''){
   alert("Please Add Balance");
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
	itemName:itemName,
balance:balance,
phone:phone,
phone1:phone1,
phone2:phone2,
phone3:phone3,
address:address,
address1:address1,
account1:account1,
account2:account2,
acctype:acctype,
type:type,
		},
   success:function(response){
	   
	  // if(response.success){
	  fetchstudent();
		//  alert(response.success)
		 location.reload();
	   
		   //Message come from controller

	  // }else{
		//   alert("Error")
	  // }
   },
   error:function(error){
	  console.log(error)
   }
});
// fetchstudent();

});
$("#updateButton").click(function(e){
e.preventDefault();
var pinv=document.getElementById("pinv").value;
var itemName=document.getElementById("itemName").value;
var balance=document.getElementById("oblc").value;
var phone=document.getElementById("phone").value;
var phone1=document.getElementById("phone1").value;
var phone2=document.getElementById("phone2").value;
var phone3=document.getElementById("phone3").value;
var address=document.getElementById("addressarea").value;
var address1=document.getElementById("addressarea1").value;
var ace11=document.getElementById("acc11").value;
var account1=ace11;
var ace21=document.getElementById("acc21").value;
var account2=ace21;
var acctype=document.getElementById("itemType").value;
var type="";
      if(document.getElementById('cre').checked == true) {   
         type="cr" ; 
}
if(document.getElementById('dre').checked == true) {   
         type="dr" ; 
} 
var url = "{{ url('updatecustomers') }}";
if(itemName==''){
   alert("Please Enter Name");
   return;
}
if(phone==''){
   alert("Please Enter Phone");
   return;
}
if(phone1==''){
   alert("Please Enter Phone 2");
   return;
}
if(address==''){
   alert("Please Enter Address");
   return;
}
if(balance==''){
   alert("Please Add Balance");
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
	pinv:pinv,
	itemName:itemName,
balance:balance,
phone:phone,
phone1:phone1,
phone2:phone2,
phone3:phone3,
address:address,
address1:address1,
account1:account1,
account2:account2,
acctype:acctype,
type:type,
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
// fetchstudent();

});
 var partyType;
    $(document).ready(function(){
  $("#searchInputParty").on("keyup", function() {
      
    // var value = $(this).val().toLowerCase();
    // $("#partytableBody tr").filter(function() {
    //   $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    // });
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
//code of click here
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('partytableBody');
    const rows = Array.from(tableBody.getElementsByTagName('tr'));
    let selectedIndex = -1;

    function updateFocus(index) {
        rows.forEach(row => row.classList.remove('focused'));
        if (index >= 0 && index < rows.length) {
            rows[index].classList.add('focused');
            rows[index].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = selectedIndex > 0 ? selectedIndex - 1 : rows.length - 1;
            updateFocus(selectedIndex);
        } else if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = selectedIndex < rows.length - 1 ? selectedIndex + 1 : 0;
            updateFocus(selectedIndex);
        } else if (e.key === 'Enter') {
            if (selectedIndex >= 0 && selectedIndex < rows.length) {
                alert('Selected: ' + rows[selectedIndex].innerText);
            }
        }
    });
});
</script>
<style>
  .focused {
    background-color: #d3d3d3;
  }
</style>
@endsection