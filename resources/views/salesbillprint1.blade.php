@php ob_start();
$covered='';
$covered1='';
$covered1mm='';
$accz='';


@endphp
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
@font-face {
    font-family: "My Custom Font";
    src: url(/files/UrdType.ttf) format("truetype");
}
label.customfont { 
    font-family: "My Custom Font", Verdana, Tahoma;
}
</style>
    <script>
       function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }
</script>
    <meta charset="utf-8">
    <title></title>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  font-size: 13px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
}

tr:nth-child(odd) {
  background-color: #dddddd;
}
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
</head>
<body>
<div>
     <h3 align="center"> <a href="https://rb.bestappsapk.com/welcome">{{$ltrhd['name']}}</a></h3>
    <p  align="center" style="margin-top:-20px;font-size:13px;">{{$ltrhd['address']}}</p>
    <p  align="center" style="margin-top:-15px;font-size:13px">Phone: {{$ltrhd['phone']}}</p>
</div>


<h3 align="center"  style="margin-top:-15px;">Sales Invoice</h3><br>

<span align:left; style="margin-top:-100px;">
    <h5   style=" text-align: left;margin-top:-40px;">Invoice Number:&nbsp;&nbsp;{{$sid}}</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Name:&nbsp;&nbsp;{{$party1['name']}}</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Address:&nbsp;&nbsp;{{$party1['address']}}</h5>
     <h5 style=" text-align:left;margin-top:-20px;">Customer Phone:&nbsp;&nbsp;{{$party1['phone']}}</h5>
 <h5 style="text-align:left;margin-top:-20px;">Dated:&nbsp;&nbsp;{{$var1['created_at']}}</h5>  
</span>

<br>

 <table style="border: 1px solid black;
  border-collapse: collapse; text-align: left; width: 100%;margin-top:-30px;font-size:12px;" align="center">
        
            <tr>
            	<th style="border: 1px solid black;" width="5%">Sr.#</th>
                <th style="border: 1px solid black;"  width="20%">Item</th>
                <th style="border: 1px solid black;" width="20%">Size</th>
                <th style="border: 1px solid black;" width="15%">Waranty</th>
                  <th style="border: 1px solid black;" width="9%">Rate</th>
                <th style="border: 1px solid black;" width="5%">Qty</th>

                <th style="border: 1px solid black;" width="12%">Price</th>
                <th style="border: 1px solid black;" width="7%">Dis</th>
               

                <th style="border: 1px solid black;" width="12%">Total</th>
            </tr>
       

            @foreach($var as $a)
    @if($a->item->brand->group['name']=='Covered') 
     @if($covered1!=$a->item->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;" colspan="9"><span><b>Covered</b></span></td>   
    </tr>
    @php $covered1=$a->item->brand->group['name'];@endphp
    @endif
<tr>
    
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['name']}}</td>
            <td style="border: 1px solid black;">{{$a->item['size']}}x{{$a->item['thikness']}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['waranty']}}</td>
            <td style="border: 1px solid black;">{{$a->unitprice}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>
            <td style="border: 1px solid black;">{{$a->price}}</td>
            <td style="border: 1px solid black;">{{$a->discount}}</td>
                         <td style="border: 1px solid black;">{{$a->price-$a->discount}}</td>
                         
        
  </tr>    
 @endif
            @endforeach
           
            @foreach($var as $a)
    @if($a->item->brand->group['name']=='Un-Covered') 
    
    
    @if($covered!=$a->item->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;" colspan="9"><span><b>Un Covered</b></span></td>   
    </tr>
    @php $covered=$a->item->brand->group['name']; @endphp
    @endif
   
<tr>
    
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['name']}}</td>
            <td style="border: 1px solid black;">{{$a->item['size']}}x{{$a->item['thikness']}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['waranty']}}</td>
            <td style="border: 1px solid black;">{{$a->unitprice}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>
            <td style="border: 1px solid black;">{{$a->price}}</td>
            <td style="border: 1px solid black;">{{$a->discount}}</td>
                         <td style="border: 1px solid black;">{{$a->price-$a->discount}}</td>
                         
        
  </tr>    
 @endif
            @endforeach
            @foreach($var as $a)
    @if($a->item->brand->group['name']=='Un-Covered MM') 
    @if($covered1mm!=$a->item->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;" colspan="9"><span><b>Un Covered MM</b></span></td>   
    </tr>
    @php $covered1mm=$a->item->brand->group['name'];  @endphp
    @endif
<tr>
    
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['name']}}</td>
            <td style="border: 1px solid black;">{{$a->item['size']}}x{{$a->item['thikness']}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['waranty']}}</td>
            <td style="border: 1px solid black;">{{$a->unitprice}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>
            <td style="border: 1px solid black;">{{$a->price}}</td>
            <td style="border: 1px solid black;">{{$a->discount}}</td>
                         <td style="border: 1px solid black;">{{$a->price-$a->discount}}</td>
                         
        
  </tr>    
 @endif
            @endforeach
            @foreach($var as $a)
    @if($a->item->brand->group['name']=='Accessories') 
   @if($accz!=$a->item->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;" colspan="9"><span><b>Accessories</b></span></td>   
    </tr>
    @php $accz=$a->item->brand->group['name']; @endphp
    @endif
<tr>
    
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['name']}}</td>
            <td style="border: 1px solid black;">{{$a->item['size']}}x{{$a->item['thikness']}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['waranty']}}</td>
            <td style="border: 1px solid black;">{{$a->unitprice}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>
            <td style="border: 1px solid black;">{{$a->price}}</td>
            <td style="border: 1px solid black;">{{$a->discount}}</td>
                         <td style="border: 1px solid black;">{{$a->price-$a->discount}}</td>
                         
        
  </tr>    
 @endif
            @endforeach
            <tr>
                <td  style="border: 1px solid black;" colspan="6"><b>Total</b></td>
               <td style="border: 1px solid black;"><b>{{$price}}</b></td>
            <td style="border: 1px solid black;"><b>{{$dix}}</b></td>
                         <td style="border: 1px solid black;"><b>{{$price-$dix}}</b></td> 
            </tr>
     
    </table>
      <span align:right>
 <p  style="margin-top:10px;font-size:14px; text-align: right;"><label>Opening Balance:</label><label id="ts"></label><label style=""> @foreach($balance as $bc){{$bc->cr-$bc->dr}}@endforeach</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Total Bill Amount:</label><label id="ts">{{$price}}</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Bill Discount:</label><label id="ts">{{$dix}}</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Final Bill Amount:</label><label id="ts">{{$price-$dix}}</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Closing Balance:</label><label id="ts">@foreach($balance1 as $bc){{$bc->cr-$bc->dr}}@endforeach</label></p>
 
 </span>
 <br>
 <p>
<label style="direction: rtl;float:right; margin-top: -40px;font-size:15px;"   class="customfont">وارنٹی کارڈ کے بغیر وارنٹی کلیم نہیں ہوگی<br>
نمی یا نا مناسب استعمال کی صورت میں کمپنی وارنٹی کلیم کے ذمہ دار نہیں ہوگی

<br>وارنٹی کمپنی کے واضح کردہ قواعد و ضوابط کے مطابق کلیم ہوگی
<br>
آپ کے تعاون اور تشریف اوری کا بے حد شکریہ</label>

</p>


   

<button  class="button" id="printpagebutton"  onclick="printpage()"><i class="fas fa-print" style="font-size:48px;"></i>  Print Now</button>
</body>
</html>
@php file_put_contents(resource_path().'/views/yourpage.blade.php', ob_get_contents()); @endphp