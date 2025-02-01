@extends('layout')
@section('container')
<script>
    
        const usersave = JSON.parse(sessionStorage.getItem('first'));
       // alert(usersave);
       console.log(usersave);
        
        if(usersave==null){
            let person = prompt("Please Enter Password", ""+usersave);
  if (person != "base64") {
    alert("Enter Correct Password");
    //sessionStorage.setItem('first', person);
     location.reload();
     
    //document.getElementById("demo").innerHTML =
   // "Hello " + person + "! How are you today?";
  }
  else{
      sessionStorage.setItem('first', person);
      
  }
        }
    
</script>
<div align="center">
<h1>Date Vise Sales</h1>
<p>Select Dates</p>
<form    onsubmit="return false">
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">

</form>
 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                   <th width="50px">No</th>
                   <th width="100px">Date</th> 
                <th>Type</th>
                <th>Brand</th>
                <th>Thikness</th>
                <th>Waranty</th>
                <th width="75px">Rate</th>
                <th width="50px">Units</th>
                
                <th  width="100px">Price</th>
                <th width="50px">Discount</th>
                 <th width="50px">Profit</th>
                <th  width="100px">Total Price</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
Total Sales: <h4 id="ts">0</h4>
Total Profit: <h4 id="ts1">0</h4>
</div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
            var url = "{{ url('date-vise-sale') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date1:date1,
date2:date2,
                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response);
        
        document.getElementById("ts").innerHTML = response.pros-response.prosz;
        document.getElementById("ts1").innerHTML = response.profit;
        $.each(response.dated,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
         //           bodyData+="<td>"+ids+"</td><td>"+item.created_at+"</td><td>"+item.product.name+"</td><td>"+item.unitprice+"</td><td>"+item.units+"</td><td>"+item.price+"</td><td>"+item.inv+"</td>";
                    
          //          bodyData+="</tr>";
            //        ids=ids+1;
               bodyData+="<td>"+ids+"</td><td>"+item.created_at+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"x"+item.item.thikness+"</td><td>"+item.item.brand.waranty+"</td><td>"+item.unitprice+"</td><td>"+item.units+"</td><td>"+item.price+"</td><td>"+item.discount+"</td><td>"+item.profit+"</td><td>"+(item.price-item.discount)+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
   


                    </script>
@endsection