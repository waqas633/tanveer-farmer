@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET"  autocomplete="off">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Add New Brand</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
	    <span  style="float:left;">Enter Series Name:</span><span  style="float:right;">
	        <select name="itemSeries" id="itemSeries" style="width: 180px;margin-top:3px;">
          <option>Select</option>
            <option value="1">Covered</option><option value="2">UnCovered</option>
            <option value="3">UnCovered MM</option><option value="4">Accessories</option>
            </select></span><br>
        <span  style="float:left; margin-top:10px;">Enter Brand Name:</span><span  style="float:right;margin-top:10px;"><div class="autocomplete"> <input type="text" name="itemName" id="itemName" placeholder="Enter Brand Name"></div></span><br>
                <span  style="float:left; margin-top:10px;">Enter Brand Waranty:</span><span  style="float:right;margin-top:10px;"><div class="autocomplete"> <input type="text" name="itemWrnt" id="itemWrnt" placeholder="Enter Brand Waratee"></div></span><br>
        </span>
	<span  style="float:left;width: 350px; margin: 3px;">
        <input type="submit" name="subs" id="subs" style="float:right;margin-right:45px;width:178px;" value="Add Brand"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
<div align="right">
	 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Brand</th>
                <th>Series</th>
                <th>Waranty</th>
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
        
var url = "{{ url('deleteBrand') }}";
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
            var url = "{{ url('fetch-brand') }}";
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
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.series+"</td><td>"+item.waranty+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }





$("#subs").click(function(e){

        e.preventDefault();
//itemSeries
        var item = $("input[name=itemName]").val();
       // var series = $("input[name=itemSeries]").val();
        var series=$("#itemSeries").find(':selected').val();
        var wrnt = $("input[name=itemWrnt]").val();
        var url = "{{ url('addBrand') }}";
       // alert(inv);
       // alert(party);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  item:item, 
                  series:series,
                  wrnt:wrnt,
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
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.series+"</td><td>"+item.waranty+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
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