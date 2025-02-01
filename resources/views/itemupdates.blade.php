@extends('layout')
@section('container')
<div class="container">
<div style="float:center;">

<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Update Product</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Type:</span><span  style="float:right;">
            <select name="type" id="type" style="width:170px;"  onchange = "branding()">
          <option>Select</option>
       <option value="1">Covered</option><option value="2">UnCovered</option>
            <option value="3">UnCovered MM</option><option value="4">Accessories</option>
            
            
            </select>
        </span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Brand:</span><span  style="float:right;">
        
            </select>
            <select name="brands" id="brands" style="width: 170px;"
              onchange = "demention()"  class="operator">
            <option value="Cash Party">Araamco</option><option value="Cash Party">Ortho</option></select>
            
        </span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Size:</span><span  style="float:right;">
            <select name="demen" id="demen" style="width: 170px;" onchange="thinkess()">
            <option value="Cash Party">1x1</option><option value="Cash Party">2x2</option></select>
            
            
        </span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Thikness:</span><span  style="float:right;">
          <select name="thik" id="thik" style="width: 170px;"  onchange = "dementionz()">
            <option value="Cash Party">1</option><option value="Cash Party">2</option></select>
          
          </span></span><br>
          
          <span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Waranty:</span><span  style="float:right;">
         <select name="waran" id="waran" style="width: 170px;">
            <option value="Cash Party">1 Year</option><option value="Cash Party">2 Year</option></select>
          
          </span></span><br>
          
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Units in Pack:</span><span  style="float:right;"><input type="text" name="packing" id="packing" placeholder="Enter Packing Size"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Sale</span><span  style="float:right;"><input type="text" name="uprice" id="uprice" placeholder="Price"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Purchase:</span><span  style="float:right;"><input type="text" name="purchase" id="purchase" placeholder="Enter Purchase Price"></span></span><br>

	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="saveproduct" style="float:right;margin-right:45px;width:178px;" value="Update Product"  class="btn btn-success" onclick="itemupgrade()"></span>
</span>
</span>

</div>
</div>
<script type="text/javascript">
function itemupgrade(){
         var search=$("#thik").find(':selected').val();
         var tp=document.getElementById('uprice').value;
            var mrp=document.getElementById('purchase').value;
            var units=document.getElementById('packing').value;
         console.log(search);
        console.log(tp);
        console.log(mrp);
        var url = "{{ url('updateitem') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search,
                  tp:tp,
                  mrp:mrp,
                  units:units,
                },
           success:function(response){
              if(response.success){
              
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
        }
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
              select = document.getElementById('brands');
              $('#brands').empty();
              var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        //console.log(response.booker);
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
        function demention(){
            var search=$("#brands").find(':selected').val();
        var url = "{{ url('brand2') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
               console.log(response.var);
              select = document.getElementById('demen');
              
              $('#demen').empty();
              $('#thik').empty();
        //console.log(response.booker);
         var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.var,function(key,item){
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.size;
    select.appendChild(opt);
        });
        select = document.getElementById('thik');
         var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.var,function(key,item){
    var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.thikness;
    select.appendChild(opt);
        });
           },
           error:function(error){
              console.log(error)
           }
        });
        }
        function thinkess(){
         var search=$("#brands").find(':selected').val();
         var search1=$("#demen").find(':selected').text();
        var url = "{{ url('thikness') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search,
                  search1:search1,
                },
           success:function(response){
               console.log(response.var);
              select = document.getElementById('thik');
              $('#thik').empty();
              // $('#uprice').value();
        //console.log(response.booker);
        var opt = document.createElement('option');
    opt.value = '0';
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.var,function(key,item){
           // document.getElementById('uprice').value=item.mrp;
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.thikness;
    select.appendChild(opt);
        });
           },
           error:function(error){
              console.log(error)
           }
        });
        }
        function dementionz(){
         var search=$("#thik").find(':selected').val();
        var url = "{{ url('brand2stock') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
               console.log(response.var);
              select = document.getElementById('waran');
              $('#waran').empty();
              // $('#uprice').value();
        //console.log(response.booker);
        $.each(response.var,function(key,item){
            document.getElementById('uprice').value=item.mrp;
            document.getElementById('purchase').value=item.tp;
            document.getElementById('packing').value=item.units;
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.brand.waranty;
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