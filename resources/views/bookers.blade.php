@extends('layout')
@section('container')
<script type="text/javascript">
	

</script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/addBooker">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Add New Employee</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Name:</span><span  style="float:right;"><input type="text" name="itemName" placeholder="Enter Name"></span></span><br>

        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Father Name:</span><span  style="float:right;">
	<input type="text" name="itemfather" placeholder="Enter Father Name"></span></span><br>

<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Select Area:</span><span  style="float:right;">
        	
 <select name="itemarea" style="width:178px;">
        	 @foreach($stx as $u)
        	<option value="{{$u->name}}">{{$u->name}}</option>
        	   @endforeach
        </select>


        </span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Address:</span><span  style="float:right;"><input type="text" name="itemAddress" placeholder="Enter Address"></span></span><br>

	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Phone:</span><span  style="float:right;"><input type="text" name="itemPhone" placeholder="Enter Phone Number"></span></span><br>

	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Phone:</span><span  style="float:right;"><input type="text" name="itemPhone1" placeholder="Enter Phone Number"></span></span><br>

	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Salary:</span><span  style="float:right;"><input type="text" name="itemSalary" placeholder="Enter Salary"></span></span><br>

	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">CNIC #:</span><span  style="float:right;"><input type="text" name="cnic" placeholder="Enter CNIC Number"></span></span><br>

        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Date:</span><span  style="float:right;"><input type="date" name="itemDate" placeholder="Enter NTN Number" value="<?php echo date('Y-m-d'); ?>" style=" width: 178px; "></span></span><br>
      
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Employee Type:</span><span  style="float:right;">
		<select name="itemType" style="width:178px;">
			<option value="Booker">Booker</option>
			<option value="Supply Man">Supply Man</option>
			<option value="Order Taker">Order Taker</option>
			<option value="Tea Man">Tea Man</option>
			<option value="Accounts">Accounts</option>
			<option value="IT">IT</option>
			<option value="Branch Manager">Baranch Manager</option>
		</select>
	</span></span><br>


     <span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="saveproduct" style="float:right;margin-right:45px;width:178px;" value="Add New Employee"  class="btn btn-success"></span>
</span>
</span>
</form>






<form method="GET" action="/updateBooker">
	@foreach($booker1 as $bk)
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Update Employee</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Name:</span><span  style="float:right;"><input type="text" name="itemName1" placeholder="Enter Name" value="{{$bk->name}}"></span></span><br>

        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Father Name:</span><span  style="float:right;">
	<input type="text" name="itemfather1" placeholder="Enter Father Name" value="{{$bk->fname}}"></span></span><br>

<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Select Area:</span><span  style="float:right;">
        	
 <select name="itemarea1" style="width:178px;">
        	 @foreach($stx as $u)
        	<option value="{{$u->name}}"{{ ( $u->name == $bk->area) ? "selected" : "" }}>{{$u->name}}</option>
        	   @endforeach
        </select>


        </span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Address:</span><span  style="float:right;"><input type="text" name="itemAddress1" placeholder="Enter Address" value="{{$bk->address}}"></span></span><br>

	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Phone:</span><span  style="float:right;"><input type="text" name="itemPhone2" placeholder="Enter Phone Number" value="{{$bk->phone}}"></span></span><br>

	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Phone:</span><span  style="float:right;"><input type="text" name="itemPhone3" placeholder="Enter Phone Number" value="{{$bk->phone1}}"></span></span><br>

	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Salary:</span><span  style="float:right;"><input type="text" name="itemSalary1" placeholder="Enter Salary" value="{{$bk->salary}}"></span></span><br>

	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">CNIC #:</span><span  style="float:right;"><input type="text" name="cnic1" placeholder="Enter CNIC Number" value="{{$bk->cnic}}"></span></span><br>

        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Date:</span><span  style="float:right;"><input type="date" name="itemDate1" placeholder="Enter NTN Number" value="<?php echo date('Y-m-d'); ?>" style=" width: 178px; "></span></span><br>
      
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Employee Type:</span><span  style="float:right;">
		<select name="itemType1" style="width:178px;">
			<option value="Booker" {{ ( "Booker" == $bk->type) ? "selected" : "" }}>Booker</option>
			<option value="Supply Man" {{ ( "Supply Man" == $bk->type) ? "selected" : "" }}>Supply Man</option>
			<option value="Order Taker" {{ ( "Order Taker" == $bk->type) ? "selected" : "" }}>Order Taker</option>
			<option value="Tea Man" {{ ( "Tea Man" == $bk->type) ? "selected" : "" }}>Tea Man</option>
			<option value="Accounts" {{ ( "Accounts" == $bk->type) ? "selected" : "" }}>Accounts</option>
			<option value="IT" {{ ( "IT" == $bk->type) ? "selected" : "" }}>IT</option>
			<option value="Branch Manager" {{ ( "Branch Manager" == $bk->type) ? "selected" : "" }}>Baranch Manager</option>
		</select>
	</span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Employee Status:</span><span  style="float:right;">
		<select name="itemType2" style="width:178px;">
			<option value="1" {{ ( "1" == $bk->status) ? "selected" : "" }}>Active</option>
			<option value="0" {{ ( "0" == $bk->status) ? "selected" : "" }}>InActive</option>
		</select>
	</span></span><br>

     <span  style="float:right;width: 350px; margin: 3px;">
     	<input type="text" name="tid" id="tid" value="{{$bk->id}}" style="width: 30px;" readonly>
        <input type="submit" name="saveproduct" style="float:right;margin-right:45px;width:178px;" value="Update Employee"  class="btn btn-success"></span>
</span>
</span>
@endforeach
</form>
</div>
</div>
 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">No</th>
                <th>Name</th>
                <th width="75px">Type</th>
                <th width="75px">Phone</th>
                
                <th  width="100px">Area</th>
                <th width="150px">Address</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        	<form action="/bookers">
        	@foreach($booking as $u)
        	
        	<tr>
        		<td>{{$u->id}}</td>
        		<td>{{$u->name}}</td>
        		<td>{{$u->type}}</td>
        		<td>{{$u->phone}} , {{$u->phone1}}</td>
        		<td>{{$u->area}}</td>
        		<td>{{$u->address}}</td>
        		<td><a  style="margin-left:10px;" href="#" onclick="{{$u->id}}"><i class='fa fa-trash'></i> Delete</a>
        			<a  style="margin-left:10px;" href="bookers?id={{$u->id}}" onclick="{{$u->id}}"><i class='fa fa-edit'></i> Update</a>
<a  style="margin-left:10px;" href="bookers?hire={{$u->id}}" onclick="{{$u->id}}"><i class='fa fa-bell'></i> Hire</a>
<a  style="margin-left:10px;" href="bookers?fire={{$u->id}}" onclick="{{$u->id}}"><i class='fa fa-bell-slash'></i> Fire</a>


        		</td>
        	</tr>
        	 @endforeach
        	</form>
        </tbody>
    </table>
@endsection