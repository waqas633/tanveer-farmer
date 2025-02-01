@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/addHead"  autocomplete="off">
<span  style="float:center;width: 500px;margin:30px;">
    <h1 align="center">Add New Expense Head</h1>
	

        Enter Expense Head:<div class="autocomplete"> <input type="text" name="itemName" id="itemName" placeholder="Enter Expense Head" style="height:40px;"></div>
        <input type="submit" name="subs" id="subs" style="margin-right:45px;width:178px; style="height:40px;"" value="Add Head"  class="btn btn-success">
</span>
</form>
</div>
<div align="right">
	 <table class="table table-bordered table-striped" style="margin-top:30px;">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Expense Head</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>


</div>
</div>
<script type="text/javascript">
  function mtd(a){
        
var url = "{{ url('deleteHead') }}";
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
fetchdata();
       }

	fetchdata();
	const productnames = [""];
	const partynames = [""];
	  function fetchdata(){
            var url = "{{ url('fetch-head') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  
                },
    success:function(response){
                     var ids=1;
        var bodyData = '';
 $.each(response.var,function(key,item){
 	
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }





$("#subs").click(function(e){

        e.preventDefault();

        var item = $("input[name=itemName]").val();
        var url = "{{ url('/addHead') }}";
       // alert(inv);
       // alert(party);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  item:item, 
                },
           success:function(response){
           	if(response.success){
              
                 alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }

              var ids=1;
        var bodyData = '';
 $.each(response.var,function(key,item){
 	
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
               
              
           },
           error:function(error){
              console.log(error)
           }
        }); 
	});
</script>
@endsection