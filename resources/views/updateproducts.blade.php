@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/updateproductsssss"   onsubmit="return false">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Update Product</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Search Name:</span><span  style="float:right;">
<div class="autocomplete">
  <input type="text" name="itemsearch" id="itemsearch" placeholder="Enter Product Name" onkeydown="rst()" onkeypress="rst()"></div></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;"><span  style="float:left;">Enter Name:</span><span  style="float:right;"><input type="text" name="itemName" id="itemName" placeholder="Enter Product Name"></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Product Formula:</span><span  style="float:right;">
	<input type="text" name="itemformula" id="itemformula" placeholder="Enter Product Formula"></span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Price:</span><span  style="float:right;"><input type="text" name="itemPrice" id="itemPrice" placeholder="Enter Price"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Purchase Price:</span><span  style="float:right;"><input type="text" name="itemPurchase" id="itemPurchase" placeholder="Enter Purchase Price"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Enter Packing Size:</span><span  style="float:right;"><input type="text" name="quantity" id="quantity" placeholder="Enter Packing Size"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Distribution</span><span  style="float:right;"><input type="text" name="itemdistribution" id="itemdistribution" placeholder="Enter Distribution Name"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Company Name:</span><span  style="float:right;"><input type="text" name="itemCompany" id="itemCompany" placeholder="Enter Company Name"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Type:</span><span  style="float:right;">
		<select name="itemType" id="itemType" style="width:178px;">
			<option value="Medicine">Medicine</option>
			<option value="Surgical">Surgical</option>
			<option value="Nutracuticle">Nutracuticle</option>
			<option value="Veccine">Veccine</option>
			<option value="Feed">Feed</option>
			<option value="Genral Item">Genral Item</option>
		</select>
	</span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Group:</span><span  style="float:right;"><input type="text" name="groupCompany" id="groupCompany" placeholder="Enter Group Name"></span></span><br>
	<span  style="float:right;width: 350px; margin: 3px;">
    <span  style="float:left;"><label id="pid">ID</label></span>   
<input type="submit" name="deleteproduct" style="float:right;margin-right:45px;" value="Delete"  class="btn btn-danger" onclick="del()">
        <input type="submit" name="saveproduct" style="float:right;margin-right:30px;" value="Update"  class="btn btn-success" onclick="pupdate()">

      </span>
</span>
</span>
</form>
</div>
</div>
<script type="text/javascript">
  function del(){
var pix=document.getElementById("pid").innerHTML;
var url = "{{ url('productdelete') }}"+"/"+pix;

$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  
                },
    success:function(response){  
    alert("Product Deleted Sucessfully"); 
}
});
  }
  function rst(){
           // var search = $("input[name=itemsearch]").val();
          var search=document.getElementById("itemsearch").value;
        
var url = "{{ url('fetch-rate') }}";

$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  search:search,
                },
    success:function(response){
      document.getElementById("itemPrice").value = response.price;
        document.getElementById("itemPurchase").value = response.purchase;
        
        document.getElementById("itemName").value = response.pname;
        document.getElementById("itemformula").value = response.formula;
        document.getElementById("quantity").value = response.pack;
        document.getElementById("itemdistribution").value = response.distribution;
        document.getElementById("itemCompany").value = response.company;
        document.getElementById("itemType").value = response.type;
         document.getElementById("groupCompany").value = response.cogroup;
         document.getElementById("pid").innerHTML = response.pid;
    
    
}
});
        }
         function pupdate(){
           // var search = $("input[name=itemsearch]").val();
          var search=document.getElementById("itemsearch").value;
          var price=document.getElementById("itemPrice").value;
        var purchase=document.getElementById("itemPurchase").value;
        var name=document.getElementById("itemName").value;
        var formula=document.getElementById("itemformula").value;
        var quantity=document.getElementById("quantity").value;
        var distribution=document.getElementById("itemdistribution").value;
        var company=document.getElementById("itemCompany").value;
        var type=document.getElementById("itemType").value;
         var cogroup=document.getElementById("groupCompany").value;
         var pid=document.getElementById("pid").innerHTML;
        
var url = "{{ url('update-rate') }}";

$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  search:search,
                  name:name,
                  price:price,
                  purchase:purchase,
                  name:name,
                  formula:formula,
                  quantity:quantity,
                  distribution:distribution,
                  company:company,
                  type:type,
                  cogroup:cogroup,
                  pid:pid,
                },
    success:function(response){
    alert("Product updated");   
}
});
        }
	const productnames = [""];
  fetchdata();
	function fetchdata(){
	
            var url = "{{ url('fetch-product') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                 
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        $.each(response.stx1,function(key,items){
     productnames.push(items.name);
     //alert(productnames);
            });
    }

});
        }
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
autocomplete(document.getElementById("itemsearch"), productnames);
//end auto search

</script>
@endsection