@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/addproduct"  autocomplete="off">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Add New Company</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Company Name:</span><span  style="float:right;"><div class="autocomplete"> <input type="text" name="itemName" id="itemName" placeholder="Enter Company Name"></div></span></span><br>
	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="subs" id="subs" style="float:right;margin-right:45px;width:178px;" value="Add Company"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
<div align="right">
	 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Company</th>
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
        
var url = "{{ url('deleteCompany') }}";
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
            var url = "{{ url('fetch-company') }}";
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
        var url = "{{ url('addCompany') }}";
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