@extends('layout')
@section('container')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
<div class="container">
<div style="float:center;">
<form method="GET" action="/addproduct"  autocomplete="off">
<span  style="float:center;width: 500px;">
	<span  style="float:left;width: 500px;">
	<h1 align="center">Add New Company Group</h1>
	<span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Select Company Name:</span><span  style="float:right;"><div class="autocomplete"> <input type="text" name="itemName" id="itemName" placeholder="Enter Company Name"></div></span></span><br>
        <span  style="float:left;width: 350px; margin: 3px;">
        <span  style="float:left;">Add Group Name:</span><span  style="float:right;"><div class="autocomplete"> <input type="text" name="itemGroup" id="itemGroup" placeholder="Enter Group Name"></div></span></span><br>
	<span  style="float:right;width: 350px; margin: 3px;">
        <input type="submit" name="subs" id="subs" style="float:right;margin-right:140px;width:178px;" value="Add New Group"  class="btn btn-success"></span>
</span>
</span>
</form>
</div>
<div align="right">
	 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Company</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="ttbody">
        </tbody>
    </table>


</div>
</div>
<script type="text/javascript">
  function mtd(a){
        
var url = "{{ url('deleteCogroup') }}";
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
	  function fetchdata(){
            var url = "{{ url('fetch-company') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  
                },
    success:function(response){
        $.each(response.var,function(key,items){
     productnames.push(items.name);
     //alert(productnames);
            });
                     var ids=1;
        var bodyData = '';
 $.each(response.var1,function(key,item){
 	
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.company+"</td><td>"+item.cgroup+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }





$("#subs").click(function(e){

        e.preventDefault();

        var item = $("input[name=itemName]").val();
        var itemGroup = $("input[name=itemGroup]").val();
        var url = "{{ url('addGroup') }}";
       // alert(inv);
       // alert(party);
        $.ajax({
           url:url,
           method:'GET',
           data:{
                  item:item,
                  itemGroup:itemGroup, 
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
                    bodyData+="<td>"+ids+"</td><td>"+item.company+"</td><td>"+item.cgroup+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
               
              
           },
           error:function(error){
              console.log(error)
           }
        }); 
        fetchdata();
	});
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
});
</script>
@endsection