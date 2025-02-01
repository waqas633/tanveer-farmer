@extends('layout')
@section('container')
<div align="center">
<h1>Date Vise Payments</h1>
<p>Select Dates</p>
<form    onsubmit="return false">
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">

</form>
 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">No</th>
                <th width="100px">Date</th>
                <th width="200px">Name</th>
                <th>Details</th>
                <th width="75px">Amount</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
Total Payments: <h4 id="ts">0</h4>
</div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
            var url = "{{ url('date-vise-payment') }}";
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
        document.getElementById("ts").innerHTML = response.pros;
        $.each(response.dated,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+item.name+"</td><td>"+item.details+"</td><td>"+item.amount+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
   


                    </script>
@endsection