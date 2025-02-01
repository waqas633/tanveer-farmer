@extends('layout')
@section('container')
<div align="center">
<h1>Product Vise Purchases</h1>
<p>Select Dates</p>
<form     onsubmit="return false">
    	<label>Type</label><select name="type" id="type" style="width: 80px;margin-top:3px;"  onchange = "branding()">
          <option>Select</option>
          <option value="1">Covered</option><option value="2">UnCovered</option>
            <option value="3">UnCovered MM</option><option value="4">Accessories</option></select>
            
            <label style="width:50px">Brand</label><select name="brands" id="brands" style="width: 80px;margin-top:3px;"
              onchange = "demention()">
            <option value="Cash Party">Araamco</option><option value="Cash Party">Ortho</option></select>
             
            
             <label style="width:80px">Demensions</label><select name="demen" id="demen" style="width: 80px;margin-top:3px;" onchange="thinkess()">
            <option value="Cash Party">1x1</option><option value="Cash Party">2x2</option></select>
            <label style="width:80px">Thikness</label><select name="thik" id="thik" style="width: 80px;margin-top:3px;"  onchange = "dementionz()">
            <option value="Cash Party">1</option><option value="Cash Party">2</option></select>
	
	<br>
	Start Date: <input type="date" id="date1" name=""  value="2023-01-01">
	Ending Date: <input type="date" id="date2" name="" value="<?php echo date('Y-m-d'); ?>">
	<input type="submit" name="" value="Show Data" onclick="fetchstudent()">

</form>
 <table class="table table-bordered table-striped">
        <thead>
            <tr>
               <th width="50px">No</th>
                <th>Type</th>
                <th>Product</th>
                <th>size</th>
                <th width="75px">U/Price</th>
                <th width="75px">Units</th>
                <th  width="100px">Price</th>
                <th  width="100px">Buy/Sell</th>
                <th  width="100px">%age</th>
                <th  width="100px">Invoice #</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>
Total Purchases: <h4 id="ts">0</h4>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
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
               console.log(response.var);
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
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
        	var cname='';
var proname=$("#thik").find(':selected').val();
            var url = "{{ url('date-vise-purchase') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date1:date1,
date2:date2,
proname:proname,
cname:cname,

                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response.dated1);
        document.getElementById("ts").innerHTML = response.pros1;
        $.each(response.dated1,function(key,item){
          $("#ttbody").html("");  
        bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"x"+item.item.thikness+"</td><td>"+item.price+"</td><td>"+item.units+"</td><td>"+item.purchase+"</td><td>"+item.batch+"/"+item.expiry+"</td><td>"+Math.round((1-(item.purchase/item.saleprice))*100)+"</td><td>"+item.id+"</td>";                  
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
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
        
        
        //search names
        fetchdata();
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
autocomplete(document.getElementById("proname"), productnames);
//end auto search
});
   


                    </script>
@endsection