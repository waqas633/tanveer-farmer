@extends('layout')
@section('container')
    
<div class="container">
    <h1  align="center" style="margin:30px;">Purchases Returns</h1>
    <div class="row">
    <div  class="col-sm-12">
    <form  method="GET" action=""  onsubmit="return false">
 <div style="width:300px; float:right; margin-right: 110px;"  align="right">
    
        
        <span style="width:150px;">Total Price</span><input type="text" name="tot" id="tot" style="margin: 3px;"><br>
        <span style="width:150px; margin-top: 10px;">Discount</span><input type="text" name="disco"  style="margin: 3px;" id="disco" value="0"><br>
        <span style="width:150px; margin-top: 10px;">Cash Paid</span><input type="text" name="cas"  style="margin: 3px;" id="cas"  onkeydown="functionBill()" value="0"><br>
        <span style="width:150px; margin-top: 10px;">Net Amount</span><input type="text" name="netcas"  style="margin: 3px;" id="netcas" value="0"><br>
        <input type="submit" name="finalBill"  class="btn btn-success" id="finalBill"  value="Final Return's" style="margin: 10px;">
    
</div>
<div style="width:300px; float:left; margin-left: 50px;"  align="right">
    
        
        <span style="width:100px; float:left;" >Bill ID</span><input type="text" name="inv" id="inv" style="margin: 3px;" value="1"><br>
        <span style="width:100px;float:left; margin-top: 10px;">Supplier</span><input type="text" name="supplier"  style="margin: 3px;" id="supplier"><br>
        <span style="width:100px;float:left; margin-top: 10px;">Bill #</span><input type="text" name="cas"  style="margin: 3px;" id="bid"><br>
        <span style="width:100px;float:left; margin-top: 10px;">Date</span><input type="text" name="netcas"  style="margin: 3px;" id="date" value="<?php echo $date=date("Y-m-d");?>"><br>
       <span style="width:100px; float:left;margin-top: 10px;">Bill Date</span><input type="text" name="netcas"  style="margin: 3px;" id="bdate" value="<?php echo $date=date("Y-m-d");?>">
    
</div>
</form>
</div>
<div class="col-sm-12"   align="center">
    <form   method="GET" action=""  onsubmit="return false" name="form" autocomplete="off">
        <div class="autocomplete">
    <span><input type="text" name="search" id="search" placeholder="Enter New Product" onkeyup="rst()"></span></div>
    <span><input type="text" name="unitprice" id="unitprice" style="width:100px;" placeholder="Units Price"></span>
     <span><input type="hidden" name="unitsale" id="unitsale" style="width:100px;" placeholder="Units Price"></span>
    <span><input type="text" name="units" id="units"  style="width:100px;" placeholder="Enter units" onkeyup="cls()"></span>
    
    <span><input type="text" name="netprice" id="netprice" placeholder="Net Price"></span>
    <span><input type="text" name="batch" id="batch"   style="width:100px;" placeholder="Batch"></span>
    <span><input type="text" name="expiry" id="expiry"   style="width:100px;" placeholder="Expiry"></span>
    <input type="submit" name="insert"  class="btn btn-success" id="subs"  value="Add Item" style="margin: 10px;">
</form>
</div>


</div>
<div  class="col-sm-12">
<table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50px">No</th>
                <th>Product</th>
                <th width="75px">U/Price</th>
                <th width="75px">Units</th>
                <th  width="100px">Price</th>
                <th  width="100px">Batch</th>
                <th  width="100px">Expiry</th>
                <th  width="100px">%age</th>
                <th   width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> 
    <script type="text/javascript">
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
        function mtd(a){
        
var url = "{{ url('purchasedeleter') }}";
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
        function cls(){
            var upp=document.getElementById("unitprice").value;
            var ups=document.getElementById("unitsale").value;
            var uus=document.getElementById("units").value;
            var purchprice=upp*uus;
            var saleprice=ups*uus;
document.getElementById("netprice").value = purchprice;
if (event.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        var vb=document.forms["form"]["units"].value;
        if(vb==null || vb==""){

        }else{
        event.preventDefault();
document.getElementById("batch").focus();
}
}

        }
        function rst(){
            var search = $("input[name=search]").val();
          
        
var url = "{{ url('fetch-rate') }}";

$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  search:search,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        console.log(response.purchase);
        document.getElementById("unitprice").value = response.purchase;
        document.getElementById("unitsale").value = response.price;
       
    }

});
if (event.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        var vb=document.forms["form"]["search"].value;
        if(vb==null || vb==""){

        }else{
        event.preventDefault();
document.getElementById("units").focus();
}
}
        }
        function fetchstudent(){
            var url = "{{ url('fetch-purchasesr') }}";
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
        document.getElementById("tot").value = response.pros;
        document.getElementById("netcas").value = response.pros;
        document.getElementById("inv").value = response.sid;
        $("tot").append(response.pros);
        $("tbody").html("");
        $.each(response.stx,function(key,item){
            document.getElementById("supplier").value=item.party;
     bodyData+="<tr>"
                    bodyData+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.price+"</td><td>"+item.units+"</td><td>"+item.purchase+"</td><td>"+item.batch+"</td><td>"+item.expiry+"</td><td>"+Math.round((1-(item.purchase/item.saleprice))*100)+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("tbody").append(bodyData);
    }

});
        }
  $(function () {

fetchstudent();
fetchdata();





      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      var route = "{{ url('autocomplete-now') }}";
       

        $('#search1').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
        var route1 = "{{ url('autopurchase-customer') }}";
         $('#supplier').typeahead({
            source: function (query, process) {
                return $.get(route1, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
        $("#subs").click(function(e){

        e.preventDefault();

        var search = $("input[name=search]").val();
        var units = $("input[name=units]").val();
        var unitprice = $("input[name=unitprice]").val();
        var unitsale = $("input[name=unitsale]").val();
        var inv = $("input[name=inv]").val();
         var party = $("input[name=supplier]").val();
         var batch = $("input[name=batch]").val();
         var expiry = $("input[name=expiry]").val();
        var url = "{{ url('purchase_singler') }}";
       

        $.ajax({
           url:url,
           method:'GET',
           data:{
                  search:search, 
                  units:units,
                  inv:inv,
                  party:party,
                  unitprice:unitprice,
                  unitsale:unitsale,
                  batch:batch,
                  expiry:expiry,
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
        document.getElementById("search").value="";
        document.getElementById("units").value="";
        document.getElementById("unitprice").value="";
             document.getElementById("unitsale").value="";
        document.getElementById("batch").value="";
        document.getElementById("expiry").value="";
         document.getElementById("netprice").value="";
         document.getElementById("search").focus();
    });
        $("#finalBill").click(function(e){

        e.preventDefault();
        var inv = $("input[name=inv]").val();
         var party = $("input[name=supplier]").val();
         var tot = $("input[name=tot]").val();
         var disco = $("input[name=disco]").val();
         var cas = $("input[name=cas]").val();
         var netcas = $("input[name=netcas]").val();
         //alert(inv);
         //alert(party);
        var url = "{{ url('finalpurchasesr') }}";

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
   });
</script>
@endsection