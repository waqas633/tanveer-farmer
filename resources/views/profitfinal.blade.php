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
<h1>Profit Statment</h1>
<form    onsubmit="return false">
	Month: <input type="month" id="date1" name=""  value="2023-01">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">

</form>

<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">Id</th>
                <th width="100px">Title</th>
                    <th width="75px">Cash</th>
              
            </tr>
        </thead>
        <tbody id="ttbody">
    
            <tr>
                
                <th width="75px">1</th>
                <th width="100px">Profit On Sales</th>
                <th width="75px"><label id="saleprofit">0</label></th>
                             
            </tr>
             <tr>
                
                <th width="75px">2</th>
                <th width="100px">Incentive</th>
                <th width="75px"><label id="incentive">0</label></th>
                             
            </tr>
             <tr>
                
                <th width="75px">3</th>
                <th width="100px">Expenses</th>
                <th width="75px"><label id="expenses">0</label></th>
                             
            </tr>
           
            <tr>
                
                <th>3</th>
                <th width="75px">Net Profit & Los</th>
                              <th width="75px"><label id="net">0</label></th>
       
             
            </tr>
        </tbody>
    </table>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
            var url = "{{ url('profitView') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date:date1,
                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response.pros2);
        console.log(response.profit);
        document.getElementById("expenses").innerHTML=parseFloat(response.pros2).toFixed(2);
        document.getElementById("saleprofit").innerHTML=parseFloat(response.profit).toFixed(2);
        document.getElementById("incentive").innerHTML=parseFloat(response.incentive).toFixed(2);
         document.getElementById("net").innerHTML=parseFloat(response.tox).toFixed(2);
    }

});
        }


                    </script>
@endsection