@extends('layout')
@section('container')
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
<div class="container">

    
    <h1 align="center">Create New Invoice Bill</h1>

  
    
        
     
         <div class="row">
             <div class="col-md-4">
                 
        <label style="width:80px;text-align: left;">Invoice No:</label><input type="text" value="1" name="inv"  style="width: 150px;" id="inv" placeholder="Enter Invoice Number"><br>
                <label style="width:80px;text-align: left;">Date</label><input type="text" name="date" id="date" style="width: 150px;"  value="<?php echo $date=date("Y-m-d");?>"><br>
<label style="width:80px;text-align: left;">Party Name</label><input type="text" name="partN" id="partN" style="margin-top: 3px;width: 150px;" value="" onclick="sst()"   onkeyup="sst()">
<br>
        <label style="width:80px;text-align: left;">Phone</label><input type="text" name="phone" id="phone" style="width: 150px;margin-top:3px;">
       <br>
       <label style="width:80px;text-align: left;">Address</label><input type="text" name="adress" id="adress" style="margin-top: 3px;width: 150px;"><br>
       <input type="submit" value="Add New Customer" class="btn btn-success" onclick="addnew()" align="right" style="margin-top:5px;margin-left:80px;" onsubmit="return false">
    
    </div>
    <div class="col-md-8">
        <label style="width:50px;text-align: left;">Type</label><select name="type" id="type" style="width: 150px;margin-top:3px;height:30px;"  onchange = "branding()">
          <option>Select</option>
            <option value="1">Covered</option><option value="2">UnCovered</option>
            <option value="3">UnCovered MM</option><option value="4">Accessories</option>
            </select>
            
            <label style="width:50px">Brand</label><select name="brands" id="brands" style="width: 80px;margin-top:3px;height:30px;"
              onchange = "demention()"  class="operator">
            <option value="0">Option</option></select>
             
            
             <label style="width:100px">Demensions</label><select name="demen" id="demen" style="width: 80px;margin-top:3px;height:30px;" onchange="thinkess()">
            <option value="0">Option</option></select><br>
            <label style="width:60px">Thikness</label><select name="thik" id="thik" style="width: 80px;margin-top:3px;height:30px;"  onchange = "dementionz()">
            <option value="0">Option</option></select>
           
            <label style="width:60px">Waranty</label><select name="waran" id="waran" style="width: 80px;margin-top:3px;height:30px;">
            <option value="0">Option</option></select>
           
    <span>
    <span><input type="text" name="units" id="units" placeholder="Units" style="width:50px;height:30px;"></span>
    <span><input type="text" name="uprice" id="uprice" placeholder="Price" style="width:50px;height:30px;"></span>
    <span><input type="text" name="disc11" id="disc11" value="0" placeholder="Discount" style="width:50px;height:30px;margin-left:5px;"></span>
    <span><input type="submit" id="subs" name="subs" class="btn btn-success" value="Add Item"   onsubmit = "fetchstudent()"><input type="text" name="netprice" id="netprice" placeholder="Net" style="width:50px;height:30px; margin-left:5px;"   onkeyup="clsdisco()"></span>
</span>
<div style="float:left;margin-left: 100px; margin-Top:30px;">
    <h4>Stock Level: <input type="text" id="sstk" name=""  readonly></h4>
    <table  class="table table-bordered table-striped" style="font-size: 12px;">
        <thead>
        <tr>
           
                <th>ID</th>
                <th>Type</th>
                
                <th>Brand</th>
                <th>Thikness</th>
                <th>Stock</th>
                <th>Sale Rate</th>
                
                
           
        </tr>
    </thead>
    <tbody id="ttbody1"></tbody>
    </table>
</div>
</div>

</div>




    



  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Invoice Details</a></li>
    <li><a data-toggle="tab" href="#menu1">Total Invoices</a></li>
  </ul>
 <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">No</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Thikness</th>
                <th>Waranty</th>
                <th width="75px">Rate</th>
                <th width="50px">Units</th>
                
                <th  width="100px">Price</th>
                <th width="50px">Discount</th>
                <th  width="100px">Total Price</th>
                <th   width="50px">Action</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
    </div>
    <div id="menu1" class="tab-pane fade">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">No</th>
                <th>Party</th>
                <th  width="180px">Date & Time</th>
                <th width="150px">Amount</th>
                <th width="75px">Discount</th>
                <th  width="150px">Net Price</th>
            </tr>
        </thead>
        <tbody id="ttbody2">
        </tbody>
    </table>
    </div>
  </div>
<div style="width:300px; float:right; margin-right: 110px;"  align="right">
    <form>
        
        <span style="width:150px;">Total Price</span><input type="text" name="tot" id="tot" style="margin: 3px;"><br>
        <span style="width:150px; margin-top: 10px;">Discount</span><input type="text" name="disco"  style="margin: 3px;" id="disco"><br>
        <span style="width:150px; margin-top: 10px;">Cash Paid</span><input type="text" name="cas"  style="margin: 3px;" id="cas"  onkeyup="functionBill()" value="0"><br>
        <span style="width:150px; margin-top: 10px;">Net Amount</span><input type="text" name="netcas"  style="margin: 3px;" id="netcas"><br>
          <input type="submit"  class="btn btn-success"  value="Print Bill" style="margin: 10px;" onclick="print()">
        <input type="submit" name="finalBill"  class="btn btn-success" id="finalBill"  value="Final Sales" style="margin: 10px;">
<a id='linkx' href="https://api.whatsapp.com/send/?phone=03346323649&text=">
        <img src="https://rb.bestappsapk.com/public/files/whatsapp.png" style="height:50px;width:50px;">
        
    </a>
    </form>
    
</div>

</div>
  
                   
                    
                


  
   
    <script type="text/javascript">
       function clsdisco(){
            var upp=document.getElementById("uprice").value;
            var netpr=document.getElementById("netprice").value;
            var perage=netpr/upp;
            var perage1=100-(perage*100)
           // var percent=upd/100;
            //var percent_value=ups*percent;
            //var final_value=ups-percent_value;
// document.getElementById("disc11").value = Math.round(perage1);
var roundedPerage1 = perage1.toFixed(2);

document.getElementById("disc11").value = roundedPerage1;
        }
    function addnew(){
         var url = "{{ url('addproductfromsales') }}";
       var party = $("input[name=partN]").val();
       var phone = $("input[name=phone]").val();
       var address = $("input[name=adress]").val();
       $.ajax({
           url:url,
           method:'POST',
           data:{
                  party:party, 
                  phone:phone,
                  address:address,
                },
           success:function(response){
               
              if(response.success){
              //fetchstudent();
                 alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
    }
        function print(){
            var pinv = $("input[name=inv]").val();
            var pdate = $("input[name=date]").val();
            var url = "{{ url('salesbillprint2?pinv=') }}"+pinv;
            var url1 = "{{ url('download-stock-vise') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{ pinv:pinv, },
    success:function(response){
    }});
$.ajax({
    url:url1,
           method:'GET',
    dataType:"json",
    data:{    },
    success:function(response){
    }});
window.open(url,'_blank');

}
          function mtd(a){
        
        
var url = "{{ url('delete') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        a:a,
                    },
    success:function(response){

      if(response.success){
              
                 alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }

    }

});

fetchstudent();
       } 

   





        var batch;
        var expiry;
        var batchunits;
        var rat;
        var pros;
        var ppt;
        var dix;
         function mts(a,b,c){
    //alert(a);
    batch=a;
    var a3=b+"/"+c;
    expiry=a3;
    //alert(a3);
       }
function sst(){
            var party = $("input[name=partN]").val();
          
        
var url = "{{ url('fetch-party') }}";
//if(event.keyCode == 13){
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  party:party,
                },
    success:function(response){
        document.getElementById("adress").value=response.area;
        document.getElementById("phone").value=response.refer;
    }

});

//}
        }




       function rst(){
           var search=$("#thik").find(':selected').val();
           // var search = $("input[name=search]").val();
            var party = $("input[name=partN]").val();
          
        
var url = "{{ url('fetch-stock') }}";
//if(event.keyCode == 13){
alert("hai");
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  search:search,
                  party:party,
                },
    success:function(response){

        var ids=1;
        var sdu=0;
        var bodyData = '';
        //console.log(response.purchase);
        batch=response.batch;
        expiry=response.expiry;
        batchunits=response.batchunits;
        ppt=response.ppt;
        rat=response.ptp;
          var pros1=response.pros1;
        console.log(pros1);
        alert(pros1);
        if(response.discount=="0"){
document.getElementById("disc11").value="0";
        }else{
        dix=response.discount['discount'];
       document.getElementById("disc11").value=dix;
   }
      
        if(pros1=="0"){
          alert("No Stock is Available");  
        }
        document.getElementById("sstk").value=pros1;
        document.getElementById("uprice").value=rat;
        var sidf=response.sids;
        
        if(pros1=="0"){
          $("#ttbody1").html("");  
        }
        //document.getElementById('units').focus();
         $.each(response.sids,function(key,item){
          $("#ttbody1").html("");  
          var a=item.batch;
          var b=item.expiry;
          var nameArr1 = b.split('/');
          var str=nameArr1[0];
          var str1=nameArr1[1];

     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.units+"</td><td>"+item.batch+"</td><td>"+item.expiry+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mts("+a+","+str+","+str1+")'>Select  <i class='fa fa-hand-o-left'></i> </a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
                    sdu=sdu+parseInt(item.units);
        })
        $("#ttbody1").append(bodyData);
        document.getElementById("sstk").innerHTML="sdu";
        
        
    }

});

//}
        }
        function functionBill() {
  $value=document.getElementById("tot").value;
  $di=document.getElementById("disco").value;
  $cas=document.getElementById("cas").value;
$netprice=$value-$di;
  $nets=$netprice-$cas;
  $nets1=Math.round($nets*100)/100;
  document.getElementById("netcas").value=$nets1;
}
function fetchstudent(){
            var url = "{{ url('fetch-student') }}";
            var inv = $("input[name=inv]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:inv,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        var bodyData1 = '';
        
        
        console.log(response.pros);
        console.log(response.stx);
        var tsc=response.pros-response.disc;
        document.getElementById("tot").value = response.pros;
        document.getElementById("inv").value = response.sid;
        document.getElementById("disco").value = response.disc;
        document.getElementById("netcas").value = tsc;
        $("tot").append(response.pros);
         var myLink = document.getElementById("linkx");
var currentHref = myLink.getAttribute("href");
    // Update the text content
   var newHref = currentHref + "Dear Customer Your Bill is= "+response.pros+"\n and Discount values is "+response.disc+" Bill No is"+inv;
    myLink.setAttribute("href", newHref);
       // document.getElementById("linkx").value="Dear Customer Your Bill is="+tot;
        //select = document.getElementById('booker');
        //console.log(response.booker);
    //    $.each(response.booker,function(key,item){
//var opt = document.createElement('option');
  //  opt.value = item.id;/
//    opt.innerHTML = item.name;
  //  select.appendChild(opt);
    //    });

console.log(response.stx);
        $.each(response.stx,function(key,item){
            $("#ttbody").html(""); 
     bodyData+="<tr>"
     document.getElementById("partN").value=item.books.name;
      sst();
    //  document.getElementById("booker").value=item.booker;
     //  document.getElementById("town").innerHTML=item.town;
                    bodyData+="<td>"+ids+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"x"+item.item.thikness+"</td><td>"+item.item.brand.waranty+"</td><td>"+item.unitprice+"</td><td>"+item.units+"</td><td>"+item.price+"</td><td>"+item.discount+"</td><td>"+(item.price-item.discount)+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        var sa=0;
        var dis=0;
        console.log(response.sbook);
        $("#ttbody").append(bodyData);
    //     $.each(response.sbook,function(key,item){
    //         $("#ttbody2").html(""); 
    //         sa=sa+parseFloat(item.sale);
    //         dis=dis+parseFloat(item.discount);
    //  bodyData1+="<tr>"
    //                 bodyData1+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.date+"  "+item.time+"</td><td>"+item.sale+"</td><td>"+item.discount+"</td><td>"+(item.sale-item.discount)+"</td>";
                    
    //                 bodyData1+="</tr>";
    //                 ids=ids+1;
    //     }

    //     )
    //     bodyData1+="<tr>"
    //                 bodyData1+="<td></td><td>Total</td><td></td><td>"+sa.toFixed(2)+"</td><td>"+dis.toFixed(2)+"</td><td>"+(sa-dis).toFixed(2)+"</td>";
                    
    //                 bodyData1+="</tr>";
    //     $("#ttbody2").append(bodyData1);
    }

});

        }
        
        function demention(){
            var search=$("#brands").find(':selected').val();
        var url = "{{ url('brand2') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
               console.log(response.var);
              select = document.getElementById('demen');
              
              $('#demen').empty();
              $('#thik').empty();
        //console.log(response.booker);
         var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.var,function(key,item){
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.size;
    select.appendChild(opt);
        });
        select = document.getElementById('thik');
         var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.var,function(key,item){
    var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.thikness;
    select.appendChild(opt);
        });
           },
           error:function(error){
              console.log(error)
           }
        });
       
        }
        function thinkess(){
         var search=$("#brands").find(':selected').val();
         var search1=$("#demen").find(':selected').text();
        var url = "{{ url('thikness') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search,
                  search1:search1,
                },
           success:function(response){
               console.log(response.var);
              select = document.getElementById('thik');
              $('#thik').empty();
              // $('#uprice').value();
        //console.log(response.booker);
        var opt = document.createElement('option');
    opt.value = '0';
    opt.innerHTML = "Select";
    select.appendChild(opt);
        $.each(response.var,function(key,item){
           // document.getElementById('uprice').value=item.mrp;
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.thikness;
    select.appendChild(opt);
        });
           },
           error:function(error){
              console.log(error)
           }
        });
        }
        function dementionz(){
            var bodyData = '';
            var ids=1;
         var search=$("#thik").find(':selected').val();
        var url = "{{ url('brand2stock') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
                document.getElementById('sstk').value=response.pros1;
               console.log(response.var);
               console.log(response.stk);
              select = document.getElementById('waran');
              
              $('#waran').empty();
              // $('#uprice').value();
        //console.log(response.booker);
        $.each(response.var,function(key,item){
            document.getElementById('uprice').value=item.mrp;
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.brand.waranty;
    select.appendChild(opt);
        });
         $.each(response.stk,function(key,item){
          $("#ttbody1").html("");  
       //   var a=item.batch;
        //  var b=item.expiry;
         // var nameArr1 = b.split('/');
         // var str=nameArr1[0];
         // var str1=nameArr1[1];

     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"x"+item.item.thikness+"</td><td>"+item.units+"</td><td>"+item.expiry+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody1").append(bodyData);
        
        
        
        
           },
           error:function(error){
              console.log(error)
           }
        });
        }
        function branding(){
         var search=$("#type").find(':selected').val();
        var url = "{{ url('brand1') }}";
       //alert(search);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
               //console.log(response.var);
              select = document.getElementById('brands');
              $('#brands').empty();
              var opt = document.createElement('option');
    opt.value = "";
    opt.innerHTML = "Select";
    select.appendChild(opt);
        //console.log(response.booker);
        $.each(response.var,function(key,item){
var opt = document.createElement('option');
    opt.value = item.id;
    opt.innerHTML = item.name;
    select.appendChild(opt);
        });
           },
           error:function(error){
              console.log(error)
           }
        });
        }
        function fetchdata(){
            var url = "{{ url('fetch-customer') }}";
            var inv = $("input[name=inv]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:inv,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        
        console.log(response.pros);
        $.each(response.stx1,function(key,items){
     productnames.push(items.name);
     //alert(productnames);
            });
    }

});
        }
const productnames = [""];
       $(function () {
         
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

        var route = "{{ url('autocomplete-search') }}";
       

        $('#search1').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
       
     
        fetchstudent();
        
        
        //search names
        fetchdata();
        
        

//start auto search
//alert(products);
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("partN"), productnames);
//end auto search




    $("#type").select(function(e){

        e.preventDefault();

        //var search = $("input[name=type]").val();
         var search=$("#type").find(':selected').val();
        var url = "{{ url('brand1') }}";
       //alert(search);
        alert(e);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                },
           success:function(response){
               console.log(response.var);
              select = document.getElementById('booker');
        //console.log(response.booker);
        $.each(response.var,function(key,item){
var opt = document.createElement('brands');
    opt.value = item.id;
    opt.innerHTML = item.name;
    select.appendChild(opt);
        });
              if(response.success){
              
                // alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
    ///document.getElementById("search").value='';
       //  document.getElementById("units").value='';
        // document.getElementById("disc11").value='0';
       //  document.getElementById("search").focus();
  // fetchstudent();
   
	});  
    $("#subs").click(function(e){

        e.preventDefault();
var search=$("#thik").find(':selected').val();
       // var search = $("input[name=search]").val();
        var units = $("input[name=units]").val();
        var uprice = $("input[name=uprice]").val();
        var inv = $("input[name=inv]").val();
        var date = $("input[name=date]").val();
         var party = $("input[name=partN]").val();
         var avail = $("input[name=sstk]").val();
         var disc11=$("input[name=disc11]").val();

        //var town='document.getElementById("town").innerHTML';
        //var booker=document.getElementById("booker").value;
        var url = "{{ url('calcu') }}";
       // alert(inv);
       // alert(party);
       
       if(party==''){
           alert("Select a Party");
           return;
       }
       if(search=='0'){
           alert("Select an Item");
           return;
       }
        if(units==''){
           alert("Please add Some Units");
           return;
       }
     //  if(units>avail){
//alert("out of stock");
//}else{
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                  units:units,
                  uprice:uprice,
                  inv:inv,
                  party:party,
                  batch:batch,
                  expiry:expiry,
                  disc11:disc11,
                  date:date,
                  town:'0',
                  booker:'0',
                   avail:avail,
                },
           success:function(response){
               
              if(response.success){
              fetchstudent();
                 //alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        });
   
   //}
    //document.getElementById("search").value='';
         document.getElementById("units").value='';
         document.getElementById("disc11").value='0';
         document.getElementById("search").focus();
   fetchstudent();
   
	});
   $("#finalBill").click(function(e){

        e.preventDefault();
        var inv = $("input[name=inv]").val();
         var party = $("input[name=partN]").val();
         var tot = $("input[name=tot]").val();
         var disco = $("input[name=disco]").val();
         var cas = $("input[name=cas]").val();
         var netcas = $("input[name=netcas]").val();
         var date = $("input[name=date]").val();
         var phone = $("input[name=phone]").val();
         //alert(inv);
         //alert(party);
         if(tot=="0"){
    alert("Add some invoice data");
}else{
        var url = "{{ url('final-bill') }}";

        $.ajax({
           url:url,
           method:'GET',
           data:{
                  inv:inv,
                  party:party,
                  tot:tot,
                  disco:disco,
                  cas:cas,
                  netcas:netcas,
                  date:date
                },
           success:function(response){
               
              if(response.success){
              
                 alert(response.success)
               location.reload();
               
                   //Message come from controller

              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
        }); 
        inv=parseInt(inv)+1;
        document.getElementById("inv").value=inv;
       // var dynamicText = "Aslam O Aleekum You have an invoice no="+inv+"/n Total Amount is="+tot+"/nDiscount is"+disco+"/nFinal Bill is "+tot-disco+"/nRecevied is "+cas ;
    //    var encodedText = encodeURIComponent(dynamicText);
      //   var whatsappLink = "https://wa.me/"+phone+"?text=" + encodedText;

    // Output the link or use it in your application logic
//    console.log(whatsappLink);
        
         fetchstudent();
         $zx="0";
}
         document.getElementById("cas").value=$zx;
         document.getElementById("netcas").value=$zx;
    });
   var route1 = "{{ url('autosale-customer') }}";
         $('#partN').typeahead({
            source: function (query, process) {
                return $.get(route1, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
   }); 


    </script>
@endsection