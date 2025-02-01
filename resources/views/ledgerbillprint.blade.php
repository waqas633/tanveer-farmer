@php
$ocr=0;
$odr=0;
foreach($open as $a){
$ocr=$a->cr;
$odr=$a->dr;
$totalDifference=0;
}

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
   <h3 align="center"> <a href="/welcome">{{$ltrhd['name']}}</a></h3>
    <p  align="center" style="margin-top:-20px;font-size:13px;">{{$ltrhd['address']}}</p>
    <p  align="center" style="margin-top:-15px;font-size:13px">Phone: {{$ltrhd['phone']}}</p>
</div>


<h3 align="center"  style="margin-top:-15px;">Customer Ledger</h3><br>

<span align:left; style="margin-top:-100px;">
    <h5  style="text-align: left;margin-top:-20px;">Customer Name:&nbsp;&nbsp;{{$party1['name']}}</h5>
    <h5  style="text-align: left;margin-top:-20px;">Customer Address:&nbsp;&nbsp;{{$party1['address']}}</h5>
     <h5 style=" text-align:left;margin-top:-20px;">Customer Phone:&nbsp;&nbsp;{{$party1['phone']}}</h5> 
</span>

<br>

 <table style="border: 1px solid black;
  border-collapse: collapse; text-align: left; width: 100%;margin-top:-30px;font-size:15px;" align="center">
        
            <tr>
            	 <th style="border: 1px solid black;"  width="10%">Rate</th>
                <th style="border: 1px solid black;"  width="10%">Date</th>
<th style="border: 1px solid black;" width="40%">Items</th>
                <th style="border: 1px solid black;" width="10%">Cr</th>
               

                <th style="border: 1px solid black;" width="10%">Dr</th>
                <th style="border: 1px solid black;" width="15%">Balance</th>
            </tr>
            @foreach($open as $a)
            <tr>
                <th style="border: 1px solid black;"  width="10%"></th>
                <th style="border: 1px solid black;" width="10%"></th>
<th style="border: 1px solid black;" width="40%">Opening Balance</th>
                <th style="border: 1px solid black;" width="10%">{{$ocr}}</th>
               

                <th style="border: 1px solid black;" width="15%">{{$odr}}</th>
            </tr>
       @endforeach

           
            @foreach($dated2 as $a)
<tr>
    
    <td  style="border: 1px solid black;">
         @if($a->type=="WholeSales")
         @php $b=$wholesales->where('id',$a->inv)->all()??0;
  foreach($b as $x){
    if($a->cr>0){
echo $x->rates;
    }  elseif($a->cr==0){
      echo "Rate: ";
echo $x->rates;
    }

    

   

    // echo  $x->item->brand['name'];
    // echo $x->item['size']; 
    // echo "x";
    // echo $x->item['thikness'];
    //  echo str_repeat("&nbsp;", 2); 
    // echo "(".$x->units.")";
    // echo str_repeat("&nbsp;",5);
    // echo $x->price-$x->discount;
    // echo "<br/>";
  }

                                        @endphp 
                                       
                                       @elseif($a->type=="LocalSales")                                
                                       @php $b=$localsales->where('inv',$a->inv)->all()??0;
                                       foreach($b as $x){
                                     echo $x->rates;
                                       }
                                       @endphp          

 
  @elseif($a->type=="BankTransection")    
                                        @endif
    </td>
            <td style="border: 1px solid black;">{{$a->date}}</td>
            <td  style="border: 1px solid black;">
            
                @if($a->type=="WholeSales")
         @php $b=$wholesales->where('id',$a->inv)->all()??0;
  foreach($b as $x){
    if($a->cr>0){
    echo " <b>Van #:</b> ";
echo $x->van;
echo " <b>Weight:</b> ";
echo $x->weight;

echo "<b>@</b> ";
echo $x->frate;
    }  elseif($a->cr==0){
    echo "Van #: ";
echo $x->van;
echo "Weight: ";
echo $x->weight;

echo "Rate: ";
echo $x->prate;
    }

    

   

    // echo  $x->item->brand['name'];
    // echo $x->item['size']; 
    // echo "x";
    // echo $x->item['thikness'];
    //  echo str_repeat("&nbsp;", 2); 
    // echo "(".$x->units.")";
    // echo str_repeat("&nbsp;",5);
    // echo $x->price-$x->discount;
    // echo "<br/>";
  }

                                        @endphp 
                                       
                                       @elseif($a->type=="LocalSales")                                
                                       @php $b=$localsales->where('inv',$a->inv)->all()??0;
                                       foreach($b as $x){
                                     echo $x->rates;
                                     echo $x->Weight;
                                     echo $x->prate;
                                     echo $x->pamount;
                                       }
                                       @endphp          

 {{-- @elseif($a->type=="Recovery")
         @php $b=$recovery->where('id',$a->inv)->all()??0;
  foreach($b as $x){
    echo  $x->details;
  }
   @endphp  --}}
    @elseif($a->type=="BankTransection")    
  
  @php $b=$bankRec->where('id',$a->inv)??0;
  foreach($b as $x){
    echo  $x->bank->name ?? 0;
    echo " - ";
  }
  foreach($b as $x){
    echo  $x->discription;
    
  }
   
  @endphp
  @else                                    
                                        
                                        
                                        
                                        {{$a->type}}
                                        @endif
                                        
            </td>
            
            <td style="border: 1px solid black;">{{$a->cr}}</td>
            <td style="border: 1px solid black;">{{$a->dr}}</td>
            <td style="border: 1px solid black;">
              {{$totalDifference+=$a->dr-$a->cr}}
                @if($totalDifference < 0)
                CR
            @else
                DR
            @endif           </td>
        
  </tr>   
            @endforeach
            
               <tr>
            	 <th style="border: 1px solid black;"  width="10%"></th>
                <th style="border: 1px solid black;"  width="10%"></th>
<th style="border: 1px solid black;" width="40%"></th>
                <th style="border: 1px solid black;" width="10%">{{$dated2->sum('cr')}}</th>
               

                <th style="border: 1px solid black;" width="10%">{{$dated2->sum('dr')}}</th>
                <th style="border: 1px solid black;" width="15%">
                    
                    {{$totalReults=$dated2->sum('dr')-$dated2->sum('cr')}}
                @if($totalReults < 0)
                CR
            @else
                DR
            @endif  
                    
                </th>
            </tr>
     
    </table>
@foreach($pros2 as $a)
   <span style="float: right; text-align: right; margin-top: 10px;">
       <label style="font-size: 14px;">Total Bill:  </label><label id="tsp" style="font-size: 14px;">{{$a->dr}}</label><br>     
    <label style="font-size: 14px;margin-top:10px;">Cash Received:  </label><label id="tsr" style="font-size: 14px;">{{$a->cr}}</label><br>

<label style="font-size: 14px;">Closing Balance:  </label><label id="ts" style="font-size: 14px;">{{$ocr-$odr+$a->cr-$a->dr}}</label></span>
   @endforeach

<button  class="button" id="printpagebutton"  onclick="printpage()"><i class="fas fa-print" style="font-size:48px;"></i>  Print Now</button>
</body>
</html>