<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>
<form method="GET" action="/updateproduct">


<span><input type="text" name="id" value="{{$u['id']}}"></span>
	<span><input type="text" name="itemName" value="{{$u['name']}}"></span>
	<span><input type="text" name="itemformula" value="{{$u['formula']}}"></span>
	<span><input type="text" name="itemPrice" value="{{$u['price']}}"></span>
	<span><input type="text" name="itemPurchase" value="{{$u['purchase']}}"></span>
	<span><input type="text" name="quantity" value="{{$u['pack']}}"></span>
	<span><input type="text" name="itemdistribution" value="{{$u['distribution']}}"></span>
	<span><input type="text" name="itemCompany" value="{{$u['company']}}"></span>
	<span>
		<label>Select Type Of Item</label>
		<select name="itemType">
			<option value="Medicine" @if($u['type']=='Medicine')  selected="selected" @endif
			>Medicine</option>
			<option value="Surgical" @if($u['type']=='Surgical') selected="selected" @endif
			>Surgical</option>
			<option value="Nutracuticle"@if($u['type']=='Nutracuticle') selected="selected" @endif
			>Nutracuticle</option>
			<option value="Veccine"@if($u['type']=='Veccine') selected="selected" @endif
			>Veccine</option>
			<option value="Feed"@if($u['type']=='Feed') selected="selected" @endif
			>Feed</option>
			<option value="Genral Item"@if($u['type']=='Genral Item') selected="selected" @endif
			>Genral Item</option>
		</select>
	</span>
	<span><input type="text" name="groupCompany" value={{$u['cogroup']}}></span>
	
	<span><input type="submit" name="saveproduct"></span>
</form>
<form action="/deleteproduct" method="get">
<input type="hidden" name="id" value="{{$u['id']}}">
	<input type="submit" value="Delete Item" name=""></form>
</body>
</html>