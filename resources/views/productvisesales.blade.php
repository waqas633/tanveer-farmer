@extends('layout')
@section('container')
<div align="center">
<h1>Date Vise Sales</h1>
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">
  <input type="submit" name="" value="Generate PDF" onclick="generatePDF()">
  <div  id="myDiv">
  <div style="padding: 10px;">
    
 <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="3%">ID</th>
            <th  width="5%">VAN</th>
            <th  width="5%">Weight</th>
            <th  width="17%">Former</th>
            <th  width="5%">Rate</th>
            <th  width="7%">Rs</th>
            <th  width="17%">Purchaser</th>
            <th  width="5%">Rate</th>
            <th  width="7%">Rs</th>
            <th  width="5%">Profit</th>
            <th  width="10%">Date</th>
        </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
  </div>
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
   

                    <script type="text/javascript">
                         
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
        	// var proname=$("#thik").find(':selected').val();
            var url = "{{ url('date-vise-sale') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
startDate:date1,
endDate:date2,
                },
    success:function(response){
      var ids=1;
        var bodyData = '';
        var bodyData1 = '';
        
        
     //   console.log(response.var);
//          var myLink = document.getElementById("linkx");
// var currentHref = myLink.getAttribute("href");
    // Update the text content
  //  var newHref = currentHref + "Dear Customer Your Bill is= "+response.pros+"\n and Discount values is "+response.disc+" Bill No is"+inv;
  //   myLink.setAttribute("href", newHref);

console.log(response.var);
var table_weight=0;
var table_former_amount=0;
var table_purchaser_amount=0;
var table_profit_amount=0;
        $.each(response.var,function(key,item){
            $("#ttbody").html(""); 
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.van+"</td><td>"+item.weight+"</td><td>"+item.rbook.name+"</td><td>"+item.frate+"</td><td>"+item.famount+"</td><td>"+item.pbook.name+"</td><td>"+item.prate+"</td><td>"+item.pamount+"</td><td>"+item.profit+"</td><td>"+item.date+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    table_weight=table_weight+parseFloat(item.weight);
                    table_former_amount=table_former_amount+parseFloat(item.famount);
                    table_purchaser_amount=table_purchaser_amount+parseFloat(item.pamount);
                    table_profit_amount=table_profit_amount+parseFloat(item.profit);
        })
        bodyData+="<td></td><td></td><td>"+table_weight+"</td><td></td><td></td><td>"+table_former_amount+"</td><td></td><td></td><td>"+table_purchaser_amount+"</td><td>"+table_profit_amount+"</td><td></td>";
        var sa=0;
        var dis=0;
        console.log(response.sbook);
        $("#ttbody").append(bodyData);
    }

});
        }
         
 
       

      
function generatePDF() {
//     // Select the div and get its content
//     var divContent = document.getElementById('myDiv').innerHTML;

//     // Create a new jsPDF instance
//     var doc = new jsPDF();

//     // Add div content to PDF
//     doc.html(divContent, {
//         callback: function(doc) {
//             // Save or download the PDF
//             doc.save('document.pdf');
//         }
//     });
var divContent = document.getElementById('myDiv');

    // Use html2pdf to generate PDF
    html2pdf()
        .from(divContent)
        .save('document.pdf');
 }



                    </script>
@endsection