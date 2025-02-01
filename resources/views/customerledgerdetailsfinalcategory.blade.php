@extends('layout')
@section('container')
<style type="text/css">
@font-face {
    font-family: "My Custom Font";
    src: url(/files/UrdType.ttf) format("truetype");
}
label.customfont { 
    font-family: "My Custom Font", Verdana, Tahoma;
}
 @media print {
            .table {
                font-size: 12px; /* Adjust the font size */
                width: 100%;
            }
            .table th, .table td {
                padding: 4px; /* Adjust padding if needed */
                border: 1px solid #000;
            }
            /* Additional print styles can be added here */
        }
</style>
    <script>
       function printpage(divId) {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        const divToPrint = document.getElementById(divId);
        //Print the page content
         if (!divToPrint) {
                console.error(`Element with ID '${divId}' not found.`);
                return;
            }

            const printFrame = document.getElementById('printFrame');
            const printDocument = printFrame.contentWindow.document;

            printDocument.open();
            printDocument.write('<html><head><title>Print</title>');
            printDocument.write('<style>body{font-family: Arial, sans-serif;} h1, p{margin: 0; padding: 0;}</style>');
            printDocument.write('</head><body>');
            printDocument.write(divToPrint.innerHTML);
            printDocument.write('</body></html>');
            printDocument.close();

            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();
        printButton.style.visibility = 'visible';
    }
</script>
<iframe id="printFrame" style="display:none;"></iframe>
<div align="center"  id="contentToPrint">
<h1>All Business Sheet</h1>

<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="4%">Cust Id</th>
                <th width="41%">Name</th>
                <th width="20%">Phone</th>
                <th width="10%">Cash Paid (DR)</th>
                <th width="10%">Cash Received (CR)</th>
                <th width="15%">Closing</th>
              
            </tr>
        </thead>
        <tbody id="ttbody">
            <?php  $grandtotal = 0; ?>
            @foreach($acctype as $ac)
            
            <?php $datedFiltered = $dated->where('book.type', $ac->type); ?>
    @if($datedFiltered->isNotEmpty())
            <tr>
                
                <th colspan="6" style="background-color: red;text-align:center;font-size: 30px;">{{$ac->type}}</th>
            </tr>
            <?php $totalDifference = 0;
                      
            ?>
            @foreach($dated->where('book.type', $ac->type) as $a)
            <tr>
                
                <th width="75px">{{$a->book['id']}}</th>
                <th width="100px">{{$a->book['name']}}</th>
                <th width="100px">{{$a->book['phone']}}</th>
                <th width="75px">{{$a->dr}}</th>
                              <th width="75px">{{$a->cr}}</th>
              
              <th width="80px">
                
                
                {{ abs($a->dr - $a->cr) }}
                @if(($a->dr-$a->cr) < 0)
                CR
            @else
                DR
            @endif
            
            </th>
            </tr>
            <?php $totalDifference += ($a->dr - $a->cr); ?>
            <?php $grandtotal += ($a->dr - $a->cr); ?>
            @endforeach
            <tr>
                <th  style="background-color:green;"></th>
                <th   style="background-color:green;" colspan="4">Total Of {{$ac->type}}</th>
                <th   style="background-color:green;" width="80px">{{ abs($totalDifference)}}
                    @if($totalDifference < 0)
                    CR
                @else
                    DR
                @endif
                
                </th>
            </tr>
            
            @endif
            @endforeach
            <tr>
                <th style="background-color:blue;"></th>
                <th  style="background-color:blue;" colspan="4">Total</th>
                <th  style="background-color:blue;" width="80px">{{ abs($grandtotal)}}
                    @if($grandtotal < 0)
                    CR
                @else
                    DR
                @endif
                
                </th>
            </tr>
            {{-- <tr>
                @foreach($dated as $b)
                <th colspan="2">Total</th>
                <th width="75px">{{$b->dr}}</th>
                              <th width="75px">{{$b->cr}}</th>
              
              <th width="80px">{{$b->dr-$b->cr}}</th>
              @endforeach
            </tr> --}}
        </tbody>
    </table>
</div>
</div>
<button  class="button" id="printpagebutton"  onclick="printpage('contentToPrint')"><i class="fas fa-print" style="font-size:48px;"></i>  Print Now</button>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
            var url = "{{ url('public-ledger') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date1:date1,
date2:date2,
                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response.pros2);
        console.log(response.dated2);
        
        $.each(response.pros2,function(key,item){
var dr=item.dr;
var cr=item.cr;
var att=cr-dr;
document.getElementById("ts").innerHTML=att;
document.getElementById("tsr").innerHTML=cr;
document.getElementById("tsp").innerHTML=dr;
        });
        
        $.each(response.dated2,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.date+"</td><td>"+cname+"</td><td>"+item.type+"</td><td>"+item.cr+"</td><td>"+item.dr+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }


                    </script>
@endsection