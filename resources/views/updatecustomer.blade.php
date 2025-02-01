@extends('layout')
@section('container')
<div class="container">
<div style="float:center;">
<form method="GET"   onsubmit="return false">
<span  style="float:center;width: 400px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Update Custmer</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Name:</span><span  style="float:right;"><input type="text" name="itemName" placeholder="Enter Customer Name" id="myInput"  onkeyup="myFunction()"></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Phone Number:</span><span  style="float:right;">
	<input type="text" name="itemformula" id="phone" placeholder="Enter Phone Number"></span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Phone 2:</span><span  style="float:right;"><input type="text" name="itemPrice" placeholder="Enter Phone Number" id="phone1"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Address:</span><span  style="float:right;"><input type="text" name="itemPurchase" placeholder="Enter Customer Address" id="address"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Address 2:</span><span  style="float:right;"><input type="text" name="quantity" placeholder="Enter Customer Address" id="address1"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Account #:</span><span  style="float:right;"><input type="text" name="itemacc" placeholder="Enter Account Number" id="acc"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Account #:</span><span  style="float:right;"><input type="text" name="itemacc1" placeholder="Enter Account Number" id="acc1"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Customer Type:</span><span  style="float:right;">
		<select name="itemType" style="width:178px;" id="itemType">
			<option value="Purchaser">Purchaser</option>
			<option value="Seller">Seller</option>
			<option value="Creditors">Creditors</option>
			<option value="Debtitors">Debitors</option>
			<option value="Whole Seller">Whole Seller</option>
			<option value="Retailer">Retailer</option>
		</select>
	</span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">CNIC/PMDC:</span><span  style="float:right;"><input type="text" name="pmdc" placeholder="Enter CNIC/PMDC Number" id="pmdc"></span></span><br>
          <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">NTN Number:</span><span  style="float:right;"><input type="text" name="ntn" placeholder="Enter NTN Number" id="ntn"></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Area:</span><span  style="float:right;">
            <select name="carea" style="width:178px;" id="carea">
             @foreach($stx as $u)
            <option value="{{$u->name}}">{{$u->name}}</option>
               @endforeach
        </select>

        </span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Reference:</span><span  style="float:right;"><select name="refer" style="width:178px;" id="refer">
             <option value="0">Select</option>
             @foreach($booker as $u)
            <option value="{{$u->name}}">{{$u->name}}</option>
               @endforeach
        </select></span></span><br>
      
	<span  style="float:right;width: 350px; margin: 3px;">
    <span  style="float:left;"><label id="pid">ID</label></span>   
        <input type="submit" name="saveproduct" style="float:right;margin-right:45px;width:178px;" value="Update"  class="btn btn-success" onclick="pupdate()">

      </span>
</span>
<span style="float:left; width: 450px; font-size: 12px;">
	<h1>Customers List</h1>
	<table id="myTable" class="table table-bordered table-striped header-fixed">
  <tr class="header">
    <th style="width:40%;">Name</th>
    <th style="width:20%;">Phone</th>
    <th style="width:30%;">Address</th>
    <th style="width:10%;">Ation</th>
  </tr>
  
  	<tbody id="ttbody"></tbody>
  
</table>


</span>
</form>
</div>
</div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> 
    <script type="text/javascript">
  function pupdate(){
           // var search = $("input[name=itemsearch]").val();
        var phone=document.getElementById("phone").value;
        var phone1=document.getElementById("phone1").value;        
        var address=document.getElementById("address").value;
        var address1=document.getElementById("address1").value;
        var pmdc=document.getElementById("pmdc").value;
        var ntn=document.getElementById("ntn").value;
        var acc1=document.getElementById("acc1").value;
        var type=document.getElementById("itemType").value;
        var name=document.getElementById("myInput").value;
         var acc=document.getElementById("acc").value;
         var pid=document.getElementById("pid").innerHTML;
         var area=document.getElementById("carea").value;
         var refer=document.getElementById("refer").value;
        
var url = "{{ url('update-customer') }}";

$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        phone:phone,
        phone1:phone1,
        address:address,
        address1:address1,
         pmdc:pmdc,
        ntn:ntn,
        type:type,
        acc:acc,
         pid:pid,
        acc1:acc1,
        refer:refer,
        area:area,
        name:name,
                },
    success:function(response){
    alert("Product updated");   
}
});
        }




    	function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
   if(event.keyCode == 13) { // 13 = Enter Key
   	var search=document.getElementById("myInput").value;
           var url = "{{ url('fetch-books') }}";
        
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  search:search,
                },
    success:function(response){
        document.getElementById("phone").value = response.phone;
        document.getElementById("phone1").value = response.phone1;        
        document.getElementById("address").value = response.address;
        document.getElementById("address1").value = response.address1;
        document.getElementById("pmdc").value = response.pmdc;
        document.getElementById("ntn").value = response.ntn;
        document.getElementById("acc1").value = response.acc1;
        document.getElementById("itemType").value = response.type;
         document.getElementById("acc").value = response.acc;
         document.getElementById("pid").innerHTML = response.pid;
         document.getElementById("carea").value = response.area;
         document.getElementById("refer").value = response.refer;
    }

});
          }
}
    	fetchstudent();
    	function fetchstudent(){
            var url = "{{ url('fetch-customer') }}";
        
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        $.each(response.stx,function(key,item){
     bodyData+="<tr>"
                    bodyData+="<td>"+item.name+"</td><td>"+item.phone+"</td><td>"+item.address+"</td><td><a  value='"+item.id+"'style='margin-left:10px; height:30px;text-align:center;' href='customerdelete/"+item.id+"'  class='btn btn-danger btn-visitor-delete'>Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
    </script>
@endsection