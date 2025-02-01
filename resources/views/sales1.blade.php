@extends('layout')
@section('container')
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
<div class="container">

    
    <h1 align="center"  style="margin:30px;">Create Return Invoice Bill</h1>

  
    <div align="center" style="margin:20px;margin-bottom: 20px;">
        
     <form method="GET" action="" autocomplete="off">
         <div class="row">
             <div class="col-md-4">
                 
        <label style="width:100px">Invoice No:</label><input type="text" value="1" name="inv" id="inv" placeholder="Enter Invoice Number">
<label style="width:100px">Party Name</label><input type="text" name="partN" id="partN" style="margin-top: 3px;" value="Cash"   onkeyup="sst()">

    
    </div>
   
</div>
</form>
</div>



    


</div>

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
    
  <h1>Returns</h1>
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
        <tbody id="ttbody12">
        </tbody>
    </table>
<div style="width:300px; float:right; margin-right: 110px;"  align="right">
    <form>
        
        <span style="width:150px;">Total Price</span><input type="text" name="tot" id="tot" style="margin: 3px;"><br>
        <span style="width:150px; margin-top: 10px;">Discount</span><input type="text" name="disco"  style="margin: 3px;" id="disco"><br>
        <span style="width:150px; margin-top: 10px;">Cash Paid</span><input type="text" name="cas"  style="margin: 3px;" id="cas"  onkeyup="functionBill()" value="0"><br>
        <span style="width:150px; margin-top: 10px;">Net Amount</span><input type="text" name="netcas"  style="margin: 3px;" id="netcas"><br>
          <input type="submit"  class="btn btn-success"  value="Print Bill" style="margin: 10px;" onclick="print()">
        <input type="submit" name="finalBill"  class="btn btn-success" id="finalBill"  value="Final Returns" style="margin: 10px;">

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
        function print(){
            var pinv = $("input[name=inv]").val();
            var url = "{{ url('salesbillprint1?pinv=') }}"+pinv;
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
        
        var a1=document.getElementById(a).value;
        alert(a1);
var url = "{{ url('/deletesales1') }}";
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
       
        function mtd1(a){
        
        var a1=document.getElementById(a).value;
        alert(a1);
var url = "{{ url('/deletesales2') }}";
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
          
        
var url = "{{ url('fetch-stock1') }}";
//if(event.keyCode == 13){
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
        console.log(response.discou);
        batch=response.batch;
        expiry=response.expiry;
        batchunits=response.batchunits;
        rat=response.rat;
        
        if(response.discount=="0"){
document.getElementById("disc11").value="0";
        }else{
        dix=response.discount;
       document.getElementById("disc11").value=dix;
   }
        var pros1=response.pros1;
        if(pros1=="0"){
          alert("No Stock is Available");  
        }
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
                    bodyData+="<td>"+ids+"</td><td>"+item.product.name+"</td><td>"+item.units+"</td><td>"+item.batch+"</td><td>"+item.expiry+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mts("+a+","+str+","+str1+")'>Select  <i class='fa fa-hand-o-left'></i> </a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody1").append(bodyData);
      
        
    }

});

//}
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
            var url = "{{ url('fetch-student1') }}";
            var inv = '<?php echo $_GET['invs']; ?>';
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
        document.getElementById("tot").value = response.pros1;
        document.getElementById("inv").value = response.sid;
        document.getElementById("disco").value = response.disc1;
        document.getElementById("netcas").value = response.pros1-response.disc1;
        $("tot").append(response.pros);
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
    //  document.getElementById("booker").value=item.booker;
     //  document.getElementById("town").innerHTML=item.town;
                    bodyData+="<td>"+ids+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"x"+item.item.thikness+"</td><td>"+item.item.brand.waranty+"</td><td>"+item.unitprice+"</td><td><input type=text style='width:40px;' id="+item.id+" value="+item.units+"></td><td>"+item.price+"</td><td>"+item.discount+"</td><td>"+(item.price-item.discount)+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='#' onclick='mtd("+item.id+")'><i class='fa fa-reply'></i> Return</a></td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        var sa=0;
        var dis=0;
        console.log(response.sbook);
        $("#ttbody").append(bodyData);
        
        console.log(response.stx3);
          $.each(response.stx3,function(key,item1){
            $("#ttbody12").html(""); 
     bodyData1+="<tr>"
    //  document.getElementById("booker").value=item.booker;
     //  document.getElementById("town").innerHTML=item.town;
                    bodyData1+="<td>"+ids+"</td><td>"+item1.item.brand.group.name+"</td><td>"+item1.item.brand.name+"</td><td>"+item1.item.size+"x"+item1.item.thikness+"</td><td>"+item1.item.brand.waranty+"</td><td>"+item1.unitprice+"</td><td>"+item1.units+"</td><td>"+item1.price+"</td><td>"+item1.discount+"</td><td>"+(item1.price-item1.discount)+"</td><td><a  value='"+item1.id+"'style='margin-left:10px;' href='#' onclick='mtd1("+item1.id+")'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData1+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody12").append(bodyData1);
    }

});
        }
        function fetchdata(){
            var url = "{{ url('fetch-student1') }}";
            var inv = '<?php echo $_GET['invs']; ?>';
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

       $(function () {
         
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

       
       

      
       
     
        fetchstudent();
        
        
        //search names
        fetchdata();
        
        





      
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
        var url = "{{ url('final-bill1') }}";

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