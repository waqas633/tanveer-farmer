@php ob_start(); @endphp
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
    <p style="margin-top:-20px;font-size:13px;">{{$ltrhd['address']}}</p>
    <p style="margin-top:-15px;font-size:13px">Phone: {{$ltrhd['phone']}}</p>
</div>


<h5 align="center"    style="margin-top:-15px;">Sales Invoice</h5><br>
    <p   style=" text-align: left;margin-top:-30px;font-size:12px;">Invoice Number:&nbsp;&nbsp;{{$sid}}</p>
    @foreach($ssds as $as)
   <div> <p  style="text-align: left;margin-top:-13px;font-size:12px;float:left">Customer Name:&nbsp;&nbsp;{{$as->book1->name}}</p>
     <p  style="text-align: left;margin-top:-13px;font-size:12px;float:right">Customer Phone:&nbsp;&nbsp;{{$as->book1->phone}}</p></div><br/>
    <div><p  style="text-align: left;margin-top:-13px;font-size:12px;float:left">Customer Address:&nbsp;&nbsp;{{$as->book1->address}}</p>
    <p  style="text-align: left;margin-top:-13px;font-size:12px;float:right">Recevier:&nbsp;&nbsp;{{$as->recevier}}</p></div><br/>
    <div> <p  style="text-align: left;margin-top:-13px;font-size:12px;float:left">Delivery Boy:&nbsp;&nbsp;{{$as->deliveryBoy}}</p>
    <p  style="text-align: left;margin-top:-13px;font-size:12px;float:right">Recevier Address:&nbsp;&nbsp;{{$as->book1->address1}}</p></div>
     
    @endforeach
     <br/>
  <p style="text-align:left;margin-top:-13px;font-size:12px;margin-left:-30px;">Dated:&nbsp;&nbsp;{{$var1['created_at']}}</p>   

 <table style="direction: rtl;border: 1px solid black;
  border-collapse: collapse; text-align: left; width: 100%;margin-top:-8px;font-size:10px;" align="center">
        
            <tr>
            	<th style="border: 1px solid black;" width="5%">Sr.#</th>
                <th style="border: 1px solid black;"  width="28%">Item</th>
                  <th style="border: 1px solid black;" width="9%">Rate</th>
                <th style="border: 1px solid black;" width="5%">Qty</th>

                <th style="border: 1px solid black;" width="12%">Price</th>
                <th style="border: 1px solid black;" width="7%">Dis</th>
               

                <th style="border: 1px solid black;" width="12%">Total</th>
            </tr>
       

            @foreach($var as $a)
         
<tr>
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">
             <label style="direction: rtl;float:right; margin-top:-7px;font-size:15px;margin-right:10px;"   class="customfont">  {{$a->product['formula']}}
               </label>
                </td>
            <td style="border: 1px solid black;">{{$a->unitprice}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>
            <td style="border: 1px solid black;">{{$a->price}}</td>
            <td style="border: 1px solid black;">{{$a->discount}}</td>
                         <td style="border: 1px solid black;">{{$a->price-$a->discount}}</td>
        
  </tr>    
 
            @endforeach
            <tr>
                <td  style="border: 1px solid black;" colspan="4">Total</td>
               <td style="border: 1px solid black;">{{$price}}</td>
            <td style="border: 1px solid black;">{{$dix}}</td>
                         <td style="border: 1px solid black;">{{$price-$dix}}</td> 
            </tr>
     
    </table>
      <span style="float:center;">
 <p  style="margin-top:1px;font-size:12px;"><label>Total Price:</label><label id="ts">{{$price}}</label></p>
 <p  style="margin-top:-13px;font-size:12px;"><label>Discount:</label><label id="ts">{{$dix}}</label></p>
 <p  style="margin-top:-13px;font-size:12px;"><label>Final Bill:</label><label id="ts">{{$price-$dix}}</label></p></span>
 <span   style="margin-top:-25px;">
<label style="direction: rtl;float:right; margin-top: -20px;font-size:15px;"   class="customfont">واپسی یا تبدیلی تین دن کے اندر اندر ھو گی</label>
<label style="direction: rtl;float:right; margin-top: -5px;font-size:15px;"   class="customfont">کاؤنٹر چھوڑنے سے پھلے بل  اور بقایارقم چیک کر لیں اور تمام ایٹم پورے کر لیں بعد میں ھم زمہ دار نا ھو گے
</label>
<label style="direction: rtl;float:right; margin-top: -5px;font-size:15px;"   class="customfont">فریج ایٹم کی واپسی یا تبدیلی نہیں ھو گی</label>
</span>


     

<button  class="button" id="printpagebutton"  onclick="printpage()"><i class="fas fa-print" style="font-size:48px;"></i>  Print Now</button>
</body>
</html>
@php file_put_contents(resource_path().'/views/yourpage.blade.php', ob_get_contents()); @endphp