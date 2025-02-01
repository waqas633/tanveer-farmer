@extends('layout')
@section('container')
<div align="center">
<h1>Invoice Vise Purchases</h1>

 <table class="table table-bordered table-striped">
        <thead>
            <tr>
              <th width="75px">No</th>
                <th>Inv#</th>
                <th>Brand</th>
                <th width="75px">Rate</th>
                <th width="50px">Units</th>
                
                <th  width="100px">Price</th>
            </tr>
        </thead>
        <tbody id="ttbody">
             @foreach($dated2 as $a)
<tr>
    
    <td style="border: 1px solid black;">{{$loop->iteration}}</td>
    <td  style="border: 1px solid black;">{{$a->purchasebook['inv']}}</td>
            <td style="border: 1px solid black;">{{$a->item->brand['name']}} {{$a->item['size']}}x{{$a->item['thikness']}}</td>
            <td style="border: 1px solid black;">{{$a->batch}}</td>
            <td style="border: 1px solid black;">{{$a->units}}</td>
            <td style="border: 1px solid black;">{{$a->purchase}}</td>
                         
        
  </tr>    
            @endforeach
           
         
          
        </tbody>
    </table>
Total Purchases: <h4 id="ts">{{$pros2}}</h4>
</div>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
                        
        function fetchstudent(){
        	var date1=document.getElementById("date1").value;
        	var date2=document.getElementById("date2").value;
            var url = "{{ url('date-vise-purchase') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
date1:date1,
date2:date2,
                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response.pros);
        console.log(response.dated);
        document.getElementById("ts").innerHTML = response.pros;
        $.each(response.dated,function(key,item){
          $("#ttbody").html("");  
     bodyData+="<tr style='height:15px;'>"
                  //  bodyData+="<td>"+ids+"</td><td>"+item.created_at+"</td><td>"+item.product.name+"</td><td>"+item.price+"</td><td>"+item.units+"</td><td>"+item.purchase+"</td><td>"+Math.round((1-(item.purchase/item.saleprice))*100)+"%</td><td>"+item.inv+"</td>";
                    
                  //  bodyData+="</tr>";
                  //  ids=ids+1;
     bodyData+="<td>"+ids+"</td><td>"+item.item.brand.group.name+"</td><td>"+item.item.brand.name+"</td><td>"+item.item.size+"*"+item.item.thikness+"</td><td>"+item.item.brand.waranty+"</td><td>"+item.unitprice+"</td><td>"+item.units+"</td><td>"+item.price+"</td><td>"+item.discount+"</td><td>"+(item.price-item.discount)+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
        })
        $("#ttbody").append(bodyData);
    }

});
        }
   


                    </script>
@endsection