@php ob_start(); @endphp
@php
$covered='';
$covered1='';
$covered1mm='';
$accz='';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>


<div align="center">
<h1>Stock Report</h1>
 <table style="border: 1px solid black;
  border-collapse: collapse; text-align: left;" align="center">
        <thead>
          <tr>
            	<th width="20px" style="border: 1px solid black;">SR. No</th>
            	<th  style="border: 1px solid black;">Group</th>
               <th  style="border: 1px solid black;">Brand</th>
                <th  style="border: 1px solid black;">Thinkess</th>
                <th  style="border: 1px solid black;" width="50px">Purchase</th>
                 <th  style="border: 1px solid black;" width="50px">Sale</th>
                <th  style="border: 1px solid black;" width="50px">Stock</th>
                <th  style="border: 1px solid black;" width="100px">Stock Amount</th>
               
                
            </tr>
        </thead>
       <tbody>
            @foreach($var as $a)
            @if($a->brand->group['name']=='Covered') 
     @if($covered1!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="8"><span><b style="text-align: center;">Covered</b></span></td>   
    </tr>
    @php $covered1=$a->brand->group['name'];@endphp
    @endif
            
            
            
            
            <tr>
                	<th  style="border: 1px solid black;" width="20px">{{$loop->iteration}}</th>
               <th  style="border: 1px solid black;">{{$a->brand->group['name']}}</th>
               <th  style="border: 1px solid black;">{{$a->brand['name']}}</th>
                <th  style="border: 1px solid black;">{{$a->size}}x{{$a->thikness}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->purchase1->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->sale->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->stock->units??0}}</th>
                <th  style="border: 1px solid black;" width="100px">{{$a->stock->price??0}}</th>
                
            </tr>
            @endif
            @endforeach
            
            
            
            
            
          @foreach($var as $a)
    @if($a->brand->group['name']=='Un-Covered') 
    
    
    @if($covered!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="8"><span><b  style="text-align: center;">Un Covered</b></span></td>   
    </tr>
    @php $covered=$a->brand->group['name']; @endphp
    @endif
    <tr>
                	<th  style="border: 1px solid black;" width="20px">{{$loop->iteration}}</th>
               <th  style="border: 1px solid black;">{{$a->brand->group['name']}}</th>
               <th  style="border: 1px solid black;">{{$a->brand['name']}}</th>
                <th  style="border: 1px solid black;">{{$a->size}}x{{$a->thikness}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->purchase1->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->sale->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->stock->units??0}}</th>
                <th  style="border: 1px solid black;" width="100px">{{$a->stock->price??0}}</th>
            </tr>   
 @endif
            @endforeach
            @foreach($var as $a)
    @if($a->brand->group['name']=='Un-Covered MM') 
    @if($covered1mm!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="8"><span><b  style="text-align: center;">Un Covered MM</b></span></td>   
    </tr>
    @php $covered1mm=$a->brand->group['name'];  @endphp
    @endif
  <tr>
                	<th  style="border: 1px solid black;" width="20px">{{$loop->iteration}}</th>
               <th  style="border: 1px solid black;">{{$a->brand->group['name']}}</th>
               <th  style="border: 1px solid black;">{{$a->brand['name']}}</th>
                <th  style="border: 1px solid black;">{{$a->size}}x{{$a->thikness}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->purchase1->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->sale->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->stock->units??0}}</th>
                <th  style="border: 1px solid black;" width="100px">{{$a->stock->price??0}}</th>
                
            </tr>   
 @endif
            @endforeach
            @foreach($var as $a)
    @if($a->brand->group['name']=='Accessories') 
   @if($accz!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="8"><span><b>Accessories</b></span></td>   
    </tr>
    @php $accz=$a->brand->group['name']; @endphp
    @endif
  <tr>
                	<th  style="border: 1px solid black;" width="20px">{{$loop->iteration}}</th>
               <th  style="border: 1px solid black;">{{$a->brand->group['name']}}</th>
               <th  style="border: 1px solid black;">{{$a->brand['name']}}</th>
                <th  style="border: 1px solid black;">{{$a->size}}x{{$a->thikness}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->purchase1->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->sale->units??0}}</th>
                <th  style="border: 1px solid black;" width="50px">{{$a->stock->units??0}}</th>
                <th  style="border: 1px solid black;" width="100px">{{$a->stock->price??0}}</th>
            </tr>   
 @endif
            @endforeach
          
        </tbody>
    </table>
Price of stock: <h4 id="ts">{{$price}}</h4>
</div>

                    
</body>
</html>
@php file_put_contents(resource_path().'/views/yourpage.blade.php', ob_get_contents()); @endphp