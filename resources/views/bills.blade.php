@extends('layout')
@section('container')
    
<h1>Search Invoice</h1>

<div class="row">

<div>                
<label style="width:50px;margin-left:10px;">Name</label>

<input type="text" id="payname" name="payname"  onkeyup="myfunction()">
 <label style="width:60px;margin-left:10px;">Address</label> <input type="text" id="address"> 

<label style="width:60px;">Invoice #</label>
<input type="text" id="inv" name="inv">
<input type="submit" value="Search Invoice" class="btn btn-success" onclick="fetchpaymentsNow()">
</div></div>
<form  method="get" action="#">
<table class="table table-bordered table-striped" style="margin-top:20px;">
        <thead>
            
            <tr>
                <th width="75px">No</th>
                <th>Party</th>
                <th  width="180px">Date & Time</th>
                <th width="150px">Total</th>
                <th width="75px">Discount</th>
                <th  width="150px">Credit</th>
                <th  width="150px">Option</th>
            </tr>
            </thead>
            
        <tbody  id="ttbody2">
            @foreach($dalysales as $a)
         
         <tr>
             <td>{{$loop->iteration}}</td>
             @foreach($a->book as $b)
                     <td>{{$b->name}}</td>
                     @endforeach
                     <td>{{$a->date}}  {{$a->time}}</td>
                     
                     <td>{{$a->sale}}</td>
                     <td>{{$a->discount}}</td>
                     <td>{{$a->balnce}}</td>
                     <td>
                         <a href="/billViseRecovery?bid={{$a->id}}"><i class="fa fa-edit" aria-hidden="true"></i>Recovery</a><br>
                         <a href="/sales1?invs={{$a->id}}"><i class="fa fa-edit" aria-hidden="true"></i>Return Invoice</a><br>
                         <a href="/salesbillprint1?pinv={{$a->id}}"  target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print Invoice # {{$a->id}}</a><br>
                         <a href="#" onclick='mtd("{{$a->id}}")'><i class="fa fa-trash" aria-hidden="true"></i> Delete Invoice</a>
                     </td>
                 
           </tr>    
          
                     @endforeach
        
        </tbody>
    </table>
    <span style="float:right;"><input type="submit" value="Recover All" class="btn btn-success"></span>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script type="text/javascript">
  
        function mtd(a){
            var result = confirm("Do You Want to delete?");
  if (result==true) {
        
var url = "{{ url('deleteinvoice') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
        pinv:a,
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
} else {
    alert("Thanks God You saved....");
  }
       }  
  
  
  
  
  
  	var uid="0";
        var bodyData1 = '';
 $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      var route = "{{ url('autopayment-now') }}";
             $('#payname').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
             $("#subs").click(function(e){
  e.preventDefault();

        var pid = uid;
        var pname = $("input[name=dbody]").val();
        var pdetails = $("input[name=rname]").val();
        var url = "{{ url('newbook') }}";
     var sa=0;
        var dis=0;
        $.ajax({
           url:url,
           method:'GET',
           dataType:"json",
           data:{
                pid:pid,
                  pname:pname,
                  pdetails:pdetails,
                },
           success:function(response){
                 $("#ttbody2").append(bodyData);
                 console.log(response.sbook);
   //    $.each(response.sbook,function(key,item){
     //      $("#ttbody2").html(""); 
       //    sa=sa+parseFloat(item.sale);
         //   dis=dis+parseFloat(item.discount);
     //bodyData1+="<tr>"
       //             bodyData1+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.date+"  "+item.time+"</td><td>"+item.sale+"</td><td>"+item.discount+"</td><td>"+(item.sale-item.discount)+"</td>";
                    
         //          bodyData1+="</tr>";
           //        ids=ids+1;
      // }
               
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
    fetchpayments();    
    });
    fetchpayments();
        function fetchpaymentsNow(){
            
            var url = "{{ url('fetch-sales-record') }}";
            var invc = $("input[name=inv]").val();
           var pid = uid;
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:pid,
                  invc:invc,
                },
    success:function(response){
        var ids=1;
        var bodyData1 = '';
        // console.log(response);
       // document.getElementById("pid").value = response.sid;
       // document.getElementById("lpay").value = response.pros;
     //   $("tot").append(response.pros);
     //   $("tbody").html("");
        var sa=0;
        var dis=0;
        $.each(response.sbook,function(key,item){
            $("#ttbody2").html(""); 
            sa=sa+parseFloat(item.sale);
            dis=dis+parseFloat(item.discount);
     bodyData1+="<tr>"
                    bodyData1+="<td>"+ids+"</td><td>"+item.book[0].name+"</td><td>"+item.date+"  "+item.time+"</td><td>"+item.sale+"</td><td>"+item.discount+"</td><td>"+(item.sale-item.discount)+"</td><td><a  value='"+item.id+"'style='margin-left:10px;' href='/billViseRecovery?bid="+item.id+"']><i class='fa fa-print'></i>Recovery Bill</a><br/><a  value='"+item.id+"'style='margin-left:10px;' href='/salesbillprint1?pinv="+item.id+"']><i class='fa fa-print'></i> View Invoice # "+item.id+"</a><br/><a  value='"+item.id+"'style='margin-left:10px;' href='/sales1?invs="+item.id+"']><i class='fa fa-edit'></i> Return</a><br/><a onclick='mtd("+item.id+")'  value='"+item.id+"'style='margin-left:10px;' href='#'><i class='fa fa-trash'></i> Delete</a></td>";
                    
                    bodyData1+="</tr>";
                    ids=ids+1;
        }

        )
        bodyData1+="<tr>"
                    bodyData1+="<td></td><td>Total</td><td></td><td>"+sa.toFixed(2)+"</td><td>"+dis.toFixed(2)+"</td><td>"+(sa-dis).toFixed(2)+"</td>";
                    
                    bodyData1+="</tr>";
        $("#ttbody2").append(bodyData1);
    }

});
        
     
    };
        function fetchpayments(){
            var url = "{{ url('fetch-recory') }}";
            var pdate = $("input[name=pdate]").val();
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  inv:pdate,
                },
    success:function(response){
        var ids=1;
        var bodyData = '';
        
        console.log(response.pros);
        document.getElementById("pid").value = response.sid;
        document.getElementById("lpay").value = response.pros;
        $("tot").append(response.pros);
        $("tbody2S").html("");
        var sa=0;
        var dis=0;
        $.each(response.sbook,function(key,item){
            $("#ttbody2").html(""); 
            sa=sa+parseFloat(item.sale);
            dis=dis+parseFloat(item.discount);
     bodyData1+="<tr>"
                    bodyData1+="<td>"+ids+"</td><td>"+item.name+"</td><td>"+item.date+"  "+item.time+"</td><td>"+item.sale+"</td><td>"+item.discount+"</td><td>"+(item.sale-item.discount)+"</td>";
                    
                    bodyData1+="</tr>";
                    ids=ids+1;
        }

        )
        bodyData1+="<tr>"
                    bodyData1+="<td></td><td>Total</td><td></td><td>"+sa.toFixed(2)+"</td><td>"+dis.toFixed(2)+"</td><td>"+(sa-dis).toFixed(2)+"</td>";
                    
                    bodyData1+="</tr>";
        $("#ttbody2").append(bodyData1);
    }

});
        
     
    };
    
    function myfunction(){
         //  if(event.keyCode == 13) { // 13 = Enter Key
   	var search=document.getElementById("payname").value;
           var url = "{{ url('fetch-books') }}";
        
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                  search:search,
                },
    success:function(response){
       // document.getElementById("phone").value = response.phone;
        //document.getElementById("phone1").value = response.phone1;        
        document.getElementById("address").value = response.address;
        // document.getElementById("address1").value = response.address1;
      //  document.getElementById("pmdc").value = response.pmdc;
     //   document.getElementById("ntn").value = response.ntn;
    //    document.getElementById("acc1").value = response.acc1;
    //    document.getElementById("itemType").value = response.type;
    //     document.getElementById("acc").value = response.acc;
     uid = response.pid;
    //     document.getElementById("carea").value = response.area;
      //   document.getElementById("refer").value = response.refer;
    }

});
       //   }
    }
   
  </script>
@endsection