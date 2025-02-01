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
     <h3 align="center"> <a href="https://rb.bestappsapk.com/welcome">RAHEEM BAKHSH FURNITURES &amp; FOAM CENTER</a></h3>
    <p  align="center" style="margin-top:-20px;font-size:13px;">Main St Town Road Near Zafar Ullah Chowk Sargodha</p>
    <p  align="center" style="margin-top:-15px;font-size:13px">Phone: 03217222207   ,    03217333353</p>
</div>


<h3 align="center"  style="margin-top:-15px;">Sales Invoice</h3><br>

<span align:left; style="margin-top:-100px;">
    <h5   style=" text-align: left;margin-top:-40px;">Invoice Number:&nbsp;&nbsp;431</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Name:&nbsp;&nbsp;Javad bhai</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Address:&nbsp;&nbsp;Sadaat Curtains</h5>
     <h5 style=" text-align:left;margin-top:-20px;">Customer Phone:&nbsp;&nbsp;03009601061</h5>
 <h5 style="text-align:left;margin-top:-20px;">Dated:&nbsp;&nbsp;2024-02-22</h5>  
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
       

                                                       
                 
    
    
          <tr>
     <td   style="border: 1px solid black;" colspan="9"><span><b>Un Covered</b></span></td>   
    </tr>
           
<tr>
    
    <td style="border: 1px solid black;">1</td>
            <td style="border: 1px solid black;">Ceat</td>
            <td style="border: 1px solid black;">72x36x2</td>
            <td style="border: 1px solid black;">10 Years</td>
            <td style="border: 1px solid black;">2477</td>
            <td style="border: 1px solid black;">2</td>
            <td style="border: 1px solid black;">4954</td>
            <td style="border: 1px solid black;">0</td>
                         <td style="border: 1px solid black;">4954</td>
                         
        
  </tr>    
                                                              
          <tr>
     <td   style="border: 1px solid black;" colspan="9"><span><b>Un Covered MM</b></span></td>   
    </tr>
        <tr>
    
    <td style="border: 1px solid black;">2</td>
            <td style="border: 1px solid black;">Ceat</td>
            <td style="border: 1px solid black;">72x36x18mm</td>
            <td style="border: 1px solid black;">10 Years</td>
            <td style="border: 1px solid black;">878</td>
            <td style="border: 1px solid black;">3</td>
            <td style="border: 1px solid black;">2634</td>
            <td style="border: 1px solid black;">0</td>
                         <td style="border: 1px solid black;">2634</td>
                         
        
  </tr>    
                                                                     <tr>
                <td  style="border: 1px solid black;" colspan="6"><b>Total</b></td>
               <td style="border: 1px solid black;"><b>7588</b></td>
            <td style="border: 1px solid black;"><b>0</b></td>
                         <td style="border: 1px solid black;"><b>7588</b></td> 
            </tr>
     
    </table>
      <span align:right>
 <p  style="margin-top:10px;font-size:14px; text-align: right;"><label>Opening Balance:</label><label id="ts"></label><label style=""> 0</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Total Bill Amount:</label><label id="ts">7588</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Bill Discount:</label><label id="ts">0</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Final Bill Amount:</label><label id="ts">7588</label></p>
 <p  style="margin-top:-13px;font-size:14px; text-align: right;"><label>Closing Balance:</label><label id="ts">-7588</label></p>
 
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
