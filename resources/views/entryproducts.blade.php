@extends('layout')
@section('container')
<div class="container">
<div style="float:center;">
<form method="GET" action="/addproduct">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Add New Product</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Name:</span><span  style="float:right;"><input type="text" name="itemName" placeholder="Enter Product Name"></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Product Formula:</span><span  style="float:right;">
	<input type="text" name="itemformula" placeholder="Enter Product Formula"></span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Price:</span><span  style="float:right;"><input type="text" name="itemPrice" placeholder="Enter Price"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Purchase Price:</span><span  style="float:right;"><input type="text" name="itemPurchase" placeholder="Enter Purchase Price"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Packing Size:</span><span  style="float:right;"><input type="text" name="quantity" placeholder="Enter Packing Size"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Distribution</span><span  style="float:right;"><input type="text" name="itemdistribution" placeholder="Enter Distribution Name"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Company Name:</span><span  style="float:right;"><input type="text" name="itemCompany" placeholder="Enter Company Name"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Type:</span><span  style="float:right;">
		<select name="itemType" style="width:178px;">
			<option value="Medicine">Medicine</option>
			<option value="Surgical">Surgical</option>
			<option value="Nutracuticle">Nutracuticle</option>
			<option value="Veccine">Veccine</option>
			<option value="Feed">Feed</option>
			<option value="Genral Item">Genral Item</option>
		</select>
	</span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Group:</span><span  style="float:right;"><input type="text" name="groupCompany" placeholder="Enter Group Name"></span></span><br>
	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="saveproduct" style="float:right;margin-right:45px;width:178px;" value="Add New Product"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
</div>
@endsection