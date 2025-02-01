@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/addproduct"  autocomplete="off">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 500px;">
	<h1 align="center">Update User Info</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">User Name:</span><span  style="float:right;"><div class="autocomplete"> <input type="text" name="itemName" id="itemName" placeholder="Enter User Name" value="{{session('user')}}" readonly=""></div></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">New Password:</span><span  style="float:right;"> <input type="password" name="itemPass" id="itemPass" placeholder="Enter New Password"></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Confrim Password:</span><span  style="float:right;"> <input type="password" name="itemPass1" id="itemPass1" placeholder="Enter New Password"></span></span><br>
	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="subs" id="subs" style="float:right;margin-right:140px;width:178px;" value="Update"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
</div>
<script type="text/javascript">
  $("#subs").click(function(e){

        e.preventDefault();

        var item = $("input[name=itemPass]").val();
        var item1 = $("input[name=itemPass1]").val();
        if(item1!==item){
alert("Enter Correct Password");
        }else{
        var itemName = $("input[name=itemName]").val();
        var url = "{{ url('updatemyuser') }}";
       // alert(inv);
       // alert(party);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  item:item,
                  itemName:itemName, 
                },
           success:function(response){
           	if(response.success){
              
                 alert(response.success)
               
               
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
	});

</script>
@endsection