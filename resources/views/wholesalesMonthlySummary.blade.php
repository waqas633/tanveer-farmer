@extends('layout')
@section('container')
<div align="center">
<h1>Date Vise Whole Sale Summary</h1>
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">
  <input type="submit" name="" value="Generate PDF" onclick="generatePDF()">
  <div  id="myDiv">
  <div style="padding: 10px;">
    
 <table class="table table-bordered table-striped">
        <thead>
          <tr style="background-color: #A3C9AA">
            <th  width="5%">Date</th>
            <th  width="5%">VAN</th>
            <th  width="5%">Weight</th>
            <th  width="7%">Purchase Amount</th>
            <th  width="7%">Sale Amount</th>
            <th  width="5%">Profit</th>
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
var date;
var date2 = 0;
var vans = 0;
var table_weight = 0;
var table_former_amount = 0;
var table_purchaser_amount = 0;
var table_profit_amount = 0;
var table_weight1 = 0;
var table_former_amount1 = 0;
var table_purchaser_amount1 = 0;
var table_profit_amount1 = 0;
var monthTotals = {}; // To store monthly totals
$("#ttbody").html(""); 
var bodyData = ""; // Initialize bodyData

$.each(response.var, function(key, item) {
    var itemWeight = parseFloat(item.weight);
    var itemFamount = parseFloat(item.famount);
    var itemPamount = parseFloat(item.pamount);
    var itemProfit = parseFloat(item.profit);

    if (date !== item.date) {
        if (date !== undefined) {
            // Accumulate to monthly totals
            var month = date.slice(0, 7); // Extract the year-month part
            if (!monthTotals[month]) {
                monthTotals[month] = {
                    weight: 0,
                    former_amount: 0,
                    purchaser_amount: 0,
                    profit_amount: 0
                };
            }
            monthTotals[month].weight += table_weight1;
            monthTotals[month].former_amount += table_former_amount1;
            monthTotals[month].purchaser_amount += table_purchaser_amount1;
            monthTotals[month].profit_amount += table_profit_amount1;

            // Reset daily totals
            table_weight1 = 0;
            table_former_amount1 = 0;
            table_purchaser_amount1 = 0;
            table_profit_amount1 = 0;
        }

        date = item.date;
    }

    // Accumulate daily totals
    table_weight1 += itemWeight;
    table_former_amount1 += itemFamount;
    table_purchaser_amount1 += itemPamount;
    table_profit_amount1 += itemProfit;

    // Accumulate overall totals
    table_weight += itemWeight;
    table_former_amount += itemFamount;
    table_purchaser_amount += itemPamount;
    table_profit_amount += itemProfit;

    date2 += 1;
    vans += 1;
});

// Add remaining totals for the last month
if (date !== undefined) {
    var month = date.slice(0, 7);
    if (!monthTotals[month]) {
        monthTotals[month] = {
            weight: 0,
            former_amount: 0,
            purchaser_amount: 0,
            profit_amount: 0
        };
    }
    monthTotals[month].weight += table_weight1;
    monthTotals[month].former_amount += table_former_amount1;
    monthTotals[month].purchaser_amount += table_purchaser_amount1;
    monthTotals[month].profit_amount += table_profit_amount1;
}

// Generate the HTML table
$.each(monthTotals, function(month, totals) {
    bodyData += "<tr style='background-color:#A3C9AA'>";
    bodyData += "<td><b>Total for " + month + "</b></td><td></td><td>" + totals.weight.toFixed(2) + "</td><td>" + totals.former_amount.toFixed(2) + "</td><td>" + totals.purchaser_amount.toFixed(2) + "</td><td>" + totals.profit_amount.toFixed(2) + "</td>";
    bodyData += "</tr>";
});

bodyData += "<tr style='background-color:#C68484'>";
bodyData += "<td><b>Totals</b></td><td>" + vans + "</td><td>" + table_weight.toFixed(2) + "</td><td>" + table_former_amount.toFixed(2) + "</td><td>" + table_purchaser_amount.toFixed(2) + "</td><td>" + table_profit_amount.toFixed(2) + "</td>";
bodyData += "</tr>";

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