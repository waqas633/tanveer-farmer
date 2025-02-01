@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/addproduct"  autocomplete="off">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 400px;">
	<h1 align="center">Add Product Discount</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Enter Name:</span><span  style="float:right;"><div class="autocomplete"> <input type="text" name="itemName" id="itemName" placeholder="Enter Product Name"></div></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Party:</span><span  style="float:right;">
        	<div class="autocomplete1">
	<input type="text" name="party" id="party" placeholder="Enter Party Name"></div></span></span><br>
<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Discount</span><span  style="float:right;"><input type="text" name="discount" id="discount"  placeholder="Enter Price"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">Start Date:</span><span  style="float:right;"><input type="date" name="sdate" id="sdate" placeholder="Enter Purchase Price"  value="<?php echo $date=date("Y-m-d");?>" style="width: 178px;"></span></span><br>
	<span  style="float:left;width: 350px;  margin: 3px;">
        <span  style="float:left;">End Date:</span><span  style="float:right;"><input type="date" name="edate" id="edate" placeholder="Enter Packing Size"  value="<?php echo $date=date("Y-m-d");?>" style="width: 178px;"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Bill Id:</span><span  style="float:right;"><input type="text" name="bid" id="bid" placeholder="Enter Distribution Bill ID"></span></span><br>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Company Name:</span><span  style="float:right;"><input type="text" name="company" id="company" placeholder="Enter Company Name"></span></span><br>
	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="subs" id="subs" style="float:right;margin-right:45px;width:178px;" value="Add Discount"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
<div>
	 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Product</th>
                <th>Party</th>
                <th width="30px">Dis</th>
                
                <th  width="100px">Company</th>
                <th width="50px">Start Date</th>
                <th  width="50px">End Date</th>
                <th   width="30px">Inv #</th>
                <th width="75px">User</th>
                <th  width="100px">Date</th>
                <th   width="30px">Status</th>
                <th   width="30px">Action</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>


</div>
</div>
<script type="text/javascript">
  function mtd(a){
        
var url = "{{ url('deleteDiscount') }}";
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
fetchdata();
       }

	fetchdata();
	const productnames = [""];
	const partynames = [""];
	  function fetchdata(){
            var url = "{{ url('fetch-student') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  
                },
    success:function(response){
      
        
        console.log(response.pros);
        $.each(response.stx1,function(key,items){
     productnames.push(items.name);
     //alert(productnames);
            });
        $.each(response.stx2,function(key,items){
     partynames.push(items.name);
     //alert(productnames);
            });
                     var ids=1;
        var bodyData = '';
 $.each(response.var,function(key,item){
 	
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.item+"</td><td>"+item.party+"</td><td>"+item.discount+"</td><td>"+item.Company+"</td><td>"+item.startDate+"</td><td>"+item.endDate+"</td><td>"+item.bill+"</td><td>"+item.user+"</td><td>"+item.date+"</td><td>"+item.status+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
$(function () {
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
autocomplete(document.getElementById("itemName"), productnames);
//end auto search
function autocomplete1(inp, arr) {
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
      a.setAttribute("id", this.id + "autocomplete1-list");
      a.setAttribute("class", "autocomplete1-items");
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
      var x = document.getElementById(this.id + "autocomplete1-list");
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
    x[currentFocus].classList.add("autocomplete1-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete1-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete1-items");
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
autocomplete1(document.getElementById("party"), partynames);






$("#subs").click(function(e){

        e.preventDefault();

        var item = $("input[name=itemName]").val();
        var party = $("input[name=party]").val();
        var discount = $("input[name=discount]").val();
         var sdate = $("input[name=sdate]").val();
         var edate = $("input[name=edate]").val();
         var bid=$("input[name=bid]").val();
         var company=$("input[name=company]").val();
        var url = "{{ url('addDisco') }}";
       // alert(inv);
       // alert(party);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  item:item, 
                  party:party,
                  discount:discount,
                  sdate:sdate,
                  edate:edate,
                  bid:bid,
                  company:company,
                },
           success:function(response){
           	if(response.success){
              
                 alert(response.success)
               
               
                   //Message come from controller

              }else{
                  alert("Error")
              }

              var ids=1;
        var bodyData = '';
 $.each(response.var,function(key,item){
 	
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.item+"</td><td>"+item.party+"</td><td>"+item.discount+"</td><td>"+item.Company+"</td><td>"+item.startDate+"</td><td>"+item.endDate+"</td><td>"+item.bill+"</td><td>"+item.user+"</td><td>"+item.date+"</td><td>"+item.status+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
               
              
           },
           error:function(error){
              console.log(error)
           }
        });
   
   
  
	});
});
</script>
@endsection
