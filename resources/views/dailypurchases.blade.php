@extends('layout')
@section('container')
<div align="center">
<h1>Date Vise Purchases</h1>
<p>Select Dates</p>
<form    onsubmit="return false">
	Start Date: <input type="date" id="date1" name="" value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">

</form>
 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50px">No</th>
                <th>Type</th>
                <th>Product</th>
                <th>size</th>
                <th width="75px">U/Price</th>
                <th width="75px">Units</th>
                <th  width="100px">Price</th>
                <th  width="100px">Buy/Sell</th>
                <th  width="100px">%age</th>
                <th   width="100px">Invoice#</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
Total Purchases: <h4 id="ts">0</h4>
</div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
            var url = "{{ url('date-vise-purchase') }}";
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
        console.log(response.pros);
        console.log(response.dated);
        document.getElementById("ts").innerHTML = response.pros;
        $.each(response.dated,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                  //  bodyData+="<td>"+ids+"</td><td>"+item.created_at+"</td><td>"+item.product.name+"</td><td>"+item.price+"</td><td>"+item.units+"</td><td>"+item.purchase+"</td><td>"+Math.round((1-(item.purchase/item.saleprice))*100)+"%</td><td>"+item.inv+"</td>";
                    
                  //  bodyData+="</tr>";
                  //  ids=ids+1;
                     bodyData+="<td>"+ids+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"*"+item.item.thikness+"</td><td>"+item.price+"</td><td>"+item.units+"</td><td>"+item.purchase+"</td><td>"+item.batch+"/"+item.expiry+"</td><td>"+Math.round((1-(item.purchase/item.saleprice))*100)+"</td><td>"+item.inv+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
   


                    </script>
@endsection