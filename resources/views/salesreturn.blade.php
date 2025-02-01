@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">

    
    <h1 align="center"  style="margin:30px;">Sales Return</h1>

  
    <div align="center" style="margin:20px;margin-bottom: 20px;">
     <form method="GET" action="" autocomplete="off">
        <span  style="float:left;width: 300px;">
        <span  style="float:left;">Invoice Number:</span><span  style="float:right;">  <input type="text" value="1" name="inv" id="inv" placeholder="Enter Invoice Number"></span>
<br>
        <span   style="float:left;margin-top: 8px;">Party Name</span><span   style="float:right;"><input type="text" name="partN" id="partN" style="margin-top: 3px;" value="Cash"   onkeyup="sst()"></span>
        <br>
        <span   style="float:left;margin-top: 13px;">Booker Name</span><span   style="float:right;"><select name="booker" id="booker" style="width: 178px;margin-top:3px;"></select><br><label id="town" style="text-align: left;">Area Town</label></span>
    </span>
    <br>
    <span    style="float:right;">
        <div class="autocomplete">
            <div style="left: 0; width: 220px;padding: 10px;  background-color: #DCDCDC;border-radius: 10px;transform: scale(0.9);">

    <span><input type="text" name="search" id="search" placeholder="Enter New Product"   onkeyup="rst()"></span></div></div>
    <span><input type="text" name="units" id="units" placeholder="Units" style="width:50px;"></span>
    <span><input type="text" name="disc11" id="disc11" value="0" placeholder="Discount" style="width:50px;"></span>
    <span><input type="submit" id="subs" name="subs" class="btn btn-success" value="Add Item"></span>
</span>


</form>
</div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="75px">No</th>
                <th>Product</th>
                <th width="75px">Rate</th>
                <th width="75px">Units</th>
                
                <th  width="100px">Price</th>
                <th width="75px">Discount</th>
                <th  width="100px">Total Price</th>
                <th   width="100px">Action</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
</div>
<div style="width:300px; float:right; margin-right: 110px;"  align="right">
    <form>
        
        <span style="width:150px;">Total Price</span><input type="text" name="tot" id="tot" style="margin: 3px;"><br>
        <span style="width:150px; margin-top: 10px;">Discount</span><input type="text" name="disco"  style="margin: 3px;" id="disco"><br>
        <span style="width:150px; margin-top: 10px;">Cash Paid</span><input type="text" name="cas"  style="margin: 3px;" id="cas"  onkeyup="functionBill()" value="0"><br>
        <span style="width:150px; margin-top: 10px;">Net Amount</span><input type="text" name="netcas"  style="margin: 3px;" id="netcas"><br>
        <input type="submit" name="finalBill"  class="btn btn-success" id="finalBill"  value="Final Return's" style="margin: 10px;">

    </form>
</div>
<div style="float:left;margin-left: 100px;">
    <h4>Stock Level: <input type="text" id="sstk" name=""  readonly></h4>
    <table  class="table table-bordered table-striped" style="font-size: 12px;">
        <thead>
        <tr>
           
                <th>ID</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Batch</th>
                <th>Expiry</th>
                
                <th>Select</th>
           
        </tr>
    </thead>
    <tbody id="ttbody1"></tbody>
    </table>
</div>




  
   
    <script type="text/javascript">
        
          function mtd(a){
        
        
var url = "{{ url('deletesalesretuns') }}";
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
    alert(a);
    batch=a;
    var a3=b+"/"+c;
    expiry=a3;
    alert(a3);
       }
function sst(){
            var party = $("input[name=partN]").val();
          
        
var url = "{{ url('fetch-party') }}";
if(event.keyCode == 39){
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  party:party,
                },
    success:function(response){
        alert(response.area);
        document.getElementById("town").innerHTML=response.area;
        document.getElementById("booker").value=response.refer;
        alert(response.refer);  
    }

});

}
        }




       function rst(){
            var search = $("input[name=search]").val();
            var party = $("input[name=partN]").val();
          
        
var url = "{{ url('fetch-stock') }}";
if(event.keyCode == 13){
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
        var bodyData = '';
        //console.log(response.purchase);
        batch=response.batch;
        expiry=response.expiry;
        batchunits=response.batchunits;
        rat=response.rat;
        if(response.discount=="0"){
document.getElementById("disc11").value="0";
        }else{
        dix=response.discount['discount'];
       document.getElementById("disc11").value=dix;
   }
        var pros1=response.pros1;
        document.getElementById("sstk").value=pros1;
        var sidf=response.sids;
        //alert(sidf);
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
        })
        $("#ttbody1").append(bodyData);
      
        
    }

});

}
        }
        function functionBill() {
  $value=document.getElementById("tot").value;
  $di=document.getElementById("disco").value;
  $cas=document.getElementById("cas").value;
$netprice=$value-$di;
  $nets=$cas-$netprice;
  $nets1=Math.round($nets*100)/100;
  document.getElementById("netcas").value=$nets1;
}
function fetchstudent(){
            var url = "{{ url('fetch-salesreturn') }}";
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
        var tsc=response.pros-response.disc;
        document.getElementById("tot").value = response.pros;
        document.getElementById("inv").value = response.sid;
        document.getElementById("disco").value = response.disc;
        document.getElementById("netcas").value = tsc;
        $("tot").append(response.pros);
        select = document.getElementById('booker');
        $.each(response.booker,function(key,item){
var opt = document.createElement('option');
    opt.value = item.name;
    opt.innerHTML = item.name;
    select.appendChild(opt);
        });


        $.each(response.stx,function(key,item){
            $("#ttbody").html(""); 
     bodyData+="<tr>"
     document.getElementById("partN").value=item.party;
      document.getElementById("booker").value=item.booker;
       document.getElementById("town").innerHTML=item.town;
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.unitprice+"</td><td>"+item.units+"</td><td>"+item.price+"</td><td>"+item.discount+"</td><td>"+(item.price-item.discount)+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
        function fetchdata(){
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
autocomplete(document.getElementById("search"), productnames);
//end auto search




      
    $("#subs").click(function(e){

        e.preventDefault();

        var search = $("input[name=search]").val();
        var units = $("input[name=units]").val();
        var inv = $("input[name=inv]").val();
         var party = $("input[name=partN]").val();
         var avail = $("input[name=sstk]").val();
         var disc11=$("input[name=disc11]").val();

        var town=document.getElementById("town").innerHTML;
        var booker=document.getElementById("booker").value;
        var url = "{{ url('calcu-sales-return') }}";
       // alert(inv);
       // alert(party);
if(units>avail){
alert("out of stock");
}else{
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                  units:units,
                  inv:inv,
                  party:party,
                  batch:batch,
                  expiry:expiry,
                  disc11:disc11,
                  town:town,
                  booker:booker,
                },
           success:function(response){
               
              if(response.success){
              
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
    document.getElementById("search").value='';
         document.getElementById("units").value='';
         document.getElementById("disc11").value='0';
        // document.getElementById("search").focus();
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
         //alert(inv);
         //alert(party);
        var url = "{{ url('final-bill-sreturn') }}";

        $.ajax({
           url:url,
           method:'GET',
           data:{
                  inv:inv,
                  party:party,
                  tot:tot,
                  disco:disco,
                  cas:cas,
                  netcas:netcas
                },
           success:function(response){
               
              if(response.success){
              
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
         fetchstudent();
         $zx="0";
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