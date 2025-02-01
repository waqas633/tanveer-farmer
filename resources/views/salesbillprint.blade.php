@php ob_start(); @endphp
<!DOCTYPE html>
<html>
<head>
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
     <h2 align="center"> <a href="https://rb.bestappsapk.com/welcome">{{$ltrhd['name']}}</a></h2>
    <p style="margin-top:-20px;">{{$ltrhd['address']}}</p>
    <p style="margin-top:-15px;">Phone: {{$ltrhd['phone']}}</p>
</div>


<h2 align="center">Sales Invoice</h2><br>

<span style="float:left;margin-top:-30px;">
    <h5   style=" text-align: left;margin-top:-20px;">Invoice Number:&nbsp;&nbsp;{{$sid}}</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Name:&nbsp;&nbsp;{{$var1['party']}}</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Address:&nbsp;&nbsp;{{$party1['address']}}</h5>
    <h5  style="text-align: left;margin-top:-20px;">User:&nbsp;&nbsp;<label style="text-transform: uppercase;">{{$var1['user']}}</label></h5>
   
</span>
<span style="float:center;margin-top:-30px;">
     <h5 style=" text-align:right;margin-top:-20px;">Customer PMDC:&nbsp;&nbsp;{{$party1['pmdc']}}</h5>
 <h5 style="text-align:right;margin-top:-20px;">Dated:&nbsp;&nbsp;{{$var1['created_at']}}</h5>
<h5 style="text-align:right;margin-top:-20px;">Customer NTN:&nbsp;&nbsp;{{$party1['ntn']}}</h5>
<h5 style="text-align:right;margin-top:-20px;">Booked By:&nbsp;&nbsp; {{$party1['refer']}}</h5>   
</span>
<br>
<div align="center" style="margin-top:20px;">
 <table style="border: 1px solid black;
  border-collapse: collapse; text-align: left; width: 100%;" align="center">
        
            <tr>
            	<th style="border: 1px solid black;" width="5%">Sr.#</th>
                <th style="border: 1px solid black;"  width="28%">Item</th>
                  <th style="border: 1px solid black;" width="9%">Rate</th>
                <th style="border: 1px solid black;" width="5%">Qty</th>

                
              

                <th style="border: 1px solid black;" width="11%">Batch</th>
                <th style="border: 1px solid black;" width="11%">Expiry</th>

                <th style="border: 1px solid black;" width="12%">Price</th>
                 <th style="border: 1px solid black;" width="5%">Dis %</th>
                <th style="border: 1px solid black;" width="7%">Dis Rs</th>
               

                <th style="border: 1px solid black;" width="12%">Total Price</th>
            </tr>
       

            @foreach($var as $a)
         
<tr>
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
            <td style="border: 1px solid black;">{{$a->name}}</td>
            <td style="border: 1px solid black;">{{$a->unitprice}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>

            

            <td style="border: 1px solid black;">{{$a->batch}}</td>
            <td style="border: 1px solid black;">{{$a->expiry}}</td>
            <td style="border: 1px solid black;">{{$a->price+$a->discount}}</td>
            <td style="border: 1px solid black;">{{$a->disage}}</td>
            <td style="border: 1px solid black;">{{$a->discount}}</td>
                         <td style="border: 1px solid black;">{{$a->price}}</td>
        
  </tr>    
 
            @endforeach
            <tr>
                <td  style="border: 1px solid black;" colspan="6">Total</td>
               <td style="border: 1px solid black;">{{$price}}</td>
               <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;">{{$dix}}</td>
                         <td style="border: 1px solid black;">{{$price-$dix}}</td> 
            </tr>
     
    </table>
  
</div>
<br>
<div style="margin-top:-30px;">
      <span style="float:right;">
 <h5><label>Total Price:</label><label id="ts">{{$price}}</label></h5>
 <h5  style="margin-top:-20px;"><label>Discount:</label><label id="ts">{{$dix}}</label></h5>
 <h5  style="margin-top:-20px;"><label>Final Bill:</label><label id="ts">{{$price-$dix}}</label></h5>



</span>

</div>
<br>
<div align="left">
    <span  style="float:left;border: 1px solid black; margin-top: 30px; width: 100%;font-size: 13px;">
    <h4  style="margin-top:20px; margin-left: 20px;text-decoration: underline;">Warranty U/S 23</h4>
    <p  style="margin-top:-10px; margin-left: 20px; margin-right: 20px;">
I , Mrs. M________, being a person resident in Pakistan carrying on business at House no 786 main lahore road Faisalabad, under the name of Jameel
Pharmaceuticals (pvt) Ltd a distributor / wholesaler / authorized agent of the drugs on this invoice, do hereby give this warranty that the drugs
invoiced as sold by us, do not contravene in any way there provision of Section 23 of Drug Act 1976.<br>
<label style="font-weight:bold;">Note :</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a - For dated items we must be informed six months perior to expiry.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b - This warranty does not apply to unani,homeopathic,biochemic,herbal and genral items.<br>
Please ensure that you have received the stock according to the quantity printed.Moreover,Please checkthe Values
and calculations and inform immediately if any deviation is observed. We do not accept any </p></span>
</div>
     

<button  class="button" id="printpagebutton"  onclick="printpage()"><i class="fas fa-print" style="font-size:48px;"></i>  Print Now</button>
</body>
</html>
@php file_put_contents(resource_path().'/views/yourpage.blade.php', ob_get_contents()); @endphp