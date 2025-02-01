@extends('layout')
@section('container')
<div class="container">
<div style="float:center;">
<form method="GET" action="/additem">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Add New Product</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Type:</span><span  style="float:right;">
            <select name="itemType" id="type" style="width:170px;"   onchange = "branding()">
               <option value="0">Select</option> 
                <option value="1">Covered</option><option value="2">UnCovered</option>
            <option value="3">UnCovered MM</option><option value="4">Accessories</option>
            </select>
        </span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Brand:</span><span  style="float:right;">
            
                <select  name="brand_id" id="brand_id" style="width:170px;">
        	 
        	<option value="0">Select</option>
        	   
        
            </select>
        </span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Size:</span><span  style="float:right;"><input type="text" name="itemSize" placeholder="Enter Size"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Thikness:</span><span  style="float:right;"><input type="text" name="itemThikness" placeholder="Enter Thikness"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Units in Pack:</span><span  style="float:right;"><input type="text" name="packing" placeholder="Enter Packing Size"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Sale</span><span  style="float:right;"><input type="text" name="sale" placeholder="Enter Sales Price"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Purchase:</span><span  style="float:right;"><input type="text" name="purchase" placeholder="Enter Purchase Price"></span></span><br>

	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="saveproduct" style="float:right;margin-right:45px;width:178px;" value="Add New Product"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
</div>
<script>
    function branding(){
         var search=$("#type").find(':selected').val();
        var url = "{{ url('brand1') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
               //console.log(response.var);
              select = document.getElementById('brand_id');
              $('#brand_id').empty();
              var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        console.log(response.branding);
        $.each(response.var,function(key,item){
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.name;
    select.appendChild(opt);
        });
           },
           error:function(error){
              console.log(error)
           }
        });
        }
</script>
@endsection