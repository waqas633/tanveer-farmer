@extends('layout')
@section('container')
@php
$covered='';
$covered1='';
$covered1mm='';
$accz='';
@endphp
<div align="center">
<h1>Stock Report</h1>
<a href="/download-stock-vise" class="btn btn-success">Download Report</a>
 <table class="table table-bordered table-striped">
        <thead>
            <tr>
            	<th width="100px">SR. No</th>

               <th>Brand</th>
                <th>Thinkess</th>
                <th width="150px">Purchase Units</th>
                 <th width="150px">Sale Units</th>
                 <!--<th width="100px">Availbility Units</th>-->
                 <!--<th width="100px">Sales Return Units</th>-->
                <th width="150px">Stock Units</th>
                <th width="150px">Stock Amount</th>
               
                
            </tr>
        </thead>
        <tbody>
            @foreach($var as $a)
            @php
            $su=0;
            $pu=0;
            $stu=0;
            $stp=0;
            $au=0;
            $sru=0;
            @endphp
            @if($a->brand->group['name']=='Covered') 
     @if($covered1!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="9"><span><b style="text-align: center;"><a href="#" class="rowToggler">Covered</a></b></span></td>   
    </tr>
    @php $covered1=$a->brand->group['name'];@endphp
    @endif
            
            
            
            
            <tr  class="Covered">
                	<th width="100px">{{$loop->iteration}}</th>
               <th>{{$a->brand['name']}}
               <br/>
               {{$a->id}}
               </th>
                <th>{{$a->size}}x{{$a->thikness}}</th>
                <th width="100px">
                    @foreach($a->purchase1??0 as $b)
            @php    $pu+=$b->units @endphp @endforeach
            
            <a href="/product-vise-purchase-view?pid={{$a->id}}">{{$pu}}</a></th>
                <th width="100px">
                @foreach($a->sale??0 as $b)
                    
               @php $su+=$b->units @endphp @endforeach
                @foreach($a->salesreturn??0 as $b)
                    
               @php $sru+=$b->units @endphp @endforeach
                
               <a href="/product-vise-sale-view?pid={{$a->id}}">{{$su-$sru}}</a>
                </th>
               <!-- <th width="100px">-->
               <!-- @foreach($a->salesreturn??0 as $b)-->
                    
               <!--@php $sru+=$b->units @endphp @endforeach-->
                
               <!--{{$sru}}-->
               <!--            </th>-->
               <!--            <th width="100px">-->
               <!-- @foreach($a->availbilitysale??0 as $b)-->
                    
               <!--@php $au+=$b->units @endphp @endforeach-->
                
               <!--{{$au}}-->
               <!--            </th>-->
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php  $stu+=(int)$b->units @endphp
                    @endforeach
                    {{$stu}}
                </th>
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php $stp+=(int)$b->price @endphp
                   @endforeach
                   
                   {{$stp}}</th>
                
            </tr>
            @endif
            @endforeach
            
            
            
            
            
          @foreach($var as $a)
           @php
            $su=0;
            $pu=0;
            $stu=0;
            $stp=0;
             $au=0;
            $sru=0;
            @endphp
    @if($a->brand->group['name']=='Un-Covered') 
    
    
    @if($covered!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="9"><span><b  style="text-align: center;"><a href="#" class="rowToggler">Un-Covered</a></b></span></td>   
    </tr>
    @php $covered=$a->brand->group['name']; @endphp
    @endif
    <tr class="Un-Covered">
                	<th width="100px">{{$loop->iteration}}</th>
               <th>{{$a->brand['name']}}
               <br/>
               {{$a->id}}
               </th>
                <th>{{$a->size}}x{{$a->thikness}}</th> 
                <th width="100px">
                    @foreach($a->purchase1??0 as $b)
            @php    $pu+=$b->units @endphp @endforeach
            
            <a href="/product-vise-purchase-view?pid={{$a->id}}">{{$pu}}</a></th>
                <th width="100px">
                @foreach($a->sale??0 as $b)
                    
               @php $su+=$b->units @endphp @endforeach
                @foreach($a->salesreturn??0 as $b)
                    
               @php $sru+=$b->units @endphp @endforeach
               <a href="/product-vise-sale-view?pid={{$a->id}}">{{$su-$sru}}</a>
                </th>
               <!-- <th width="100px">-->
               <!-- @foreach($a->salesreturn??0 as $b)-->
                    
               <!--@php $sru+=$b->units @endphp @endforeach-->
                
               <!--{{$sru}}-->
               <!--            </th>-->
               <!--            <th width="100px">-->
               <!-- @foreach($a->availbilitysale??0 as $b)-->
                    
               <!--@php $au+=$b->units @endphp @endforeach-->
                
               <!--{{$au}}-->
               <!--            </th>-->
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php  $stu+=(int)$b->units @endphp
                    @endforeach
                    {{$stu}}
                </th>
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php $stp+=(int)$b->price @endphp
                   @endforeach
                   
                   {{$stp}}</th>
            </tr>   
 @endif
            @endforeach
            @foreach($var as $a)
             @php
            $su=0;
            $pu=0;
            $stu=0;
            $stp=0;
             $au=0;
            $sru=0;
            @endphp
    @if($a->brand->group['name']=='Un-Covered MM') 
    @if($covered1mm!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="9"><span><b  style="text-align: center;"><a href="#" class="rowToggler">Un-Covered-MM</a></b></span></td>   
    </tr>
    @php $covered1mm=$a->brand->group['name'];  @endphp
    @endif
  <tr class="Un-Covered-MM">
                	<th width="100px">{{$loop->iteration}}</th>
               <th>{{$a->brand['name']}}
               <br/>
               {{$a->id}}
               </th>
                <th>{{$a->size}}x{{$a->thikness}}</th>
             <th width="100px">
                    @foreach($a->purchase1??0 as $b)
            @php    $pu+=$b->units @endphp @endforeach
            
            <a href="/product-vise-purchase-view?pid={{$a->id}}">{{$pu}}</a></th>
                <th width="100px">
                @foreach($a->sale??0 as $b)
                    
               @php $su+=$b->units @endphp @endforeach
                @foreach($a->salesreturn??0 as $b)
                    
               @php $sru+=$b->units @endphp @endforeach
              <a href="/product-vise-sale-view?pid={{$a->id}}">{{$su-$sru}}</a>
                </th>
               <!-- <th width="100px">-->
               <!-- @foreach($a->salesreturn??0 as $b)-->
                    
               <!--@php $sru+=$b->units @endphp @endforeach-->
                
               <!--{{$sru}}-->
               <!--            </th>-->
               <!--            <th width="100px">-->
               <!-- @foreach($a->availbilitysale??0 as $b)-->
                    
               <!--@php $au+=$b->units @endphp @endforeach-->
                
               <!--{{$au}}-->
               <!--            </th>-->
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php  $stu+=(int)$b->units @endphp
                    @endforeach
                    {{$stu}}
                </th>
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php $stp+=(int)$b->price @endphp
                   @endforeach
                   
                   {{$stp}}</th>
                
            </tr>   
 @endif
            @endforeach
            @foreach($var as $a)
             @php
            $su=0;
            $pu=0;
            $stu=0;
            $stp=0;
             $au=0;
            $sru=0;
            @endphp
    @if($a->brand->group['name']=='Accessories') 
   @if($accz!=$a->brand->group['name'])
      <tr>
     <td   style="border: 1px solid black;text-align: center;" colspan="9"><span><b><a href="#" class="rowToggler">Accessories</a></b></span></td>   
    </tr>
    @php $accz=$a->brand->group['name']; @endphp
    @endif
                <tr class="Accessories">
                	<th width="100px">{{$loop->iteration}}</th>
               <th>{{$a->brand['name']}}
               <br/>
               {{$a->id}}
               </th>
                <th>{{$a->size}}x{{$a->thikness}}</th>
          <th width="100px">
                    @foreach($a->purchase1??0 as $b)
            @php    $pu+=$b->units @endphp @endforeach
            
            <a href="/product-vise-purchase-view?pid={{$a->id}}">{{$pu}}</a></th>
                <th width="100px">
                @foreach($a->sale??0 as $b)
                    
               @php $su+=$b->units @endphp @endforeach
                @foreach($a->salesreturn??0 as $b)
                    
               @php $sru+=$b->units @endphp @endforeach
                
                <a href="/product-vise-sale-view?pid={{$a->id}}">{{$su-$sru}}</a>
                </th>
               <!-- <th width="100px">-->
               <!-- @foreach($a->salesreturn??0 as $b)-->
                    
               <!--@php $sru+=$b->units @endphp @endforeach-->
                
               <!--{{$sru}}-->
               <!--            </th>-->
               <!--            <th width="100px">-->
               <!-- @foreach($a->availbilitysale??0 as $b)-->
                    
               <!--@php $au+=$b->units @endphp @endforeach-->
                
               <!--{{$au}}-->
               <!--            </th>-->
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php  $stu+=(int)$b->units @endphp
                    @endforeach
                 {{$stu}}
                </th>
                <th width="100px">
                @foreach($a->stock??0 as $b)
                  @php $stp+=(int)$b->price @endphp
                   @endforeach
                   
                   {{$stp}}</th>
            </tr>   
 @endif
            @endforeach
          
        </tbody>
        <tbody id="ttbody">
        </tbody>
    </table>
Price of stock: <h4 id="ts">{{$price}}</h4>
</div>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                    <script type="text/javascript">
$( document ).ready( function() {
     $("tr[class^='Covered']").hide();
     $("tr[class^='Un-Covered']").hide();
     $("tr[class^='Un-Covered-MM']").hide();
     $("tr[class^='Accessories']").hide();
  $( "a.rowToggler" ).click( function( e ) {
    e.preventDefault();
    var dept = $( this ).text().replace( /\s/g, "" );
    $( "tr[class=" + dept + "]" ).toggle();
  })
});
                 fetchstudent();       
        function fetchstudent(){
var url1 = "{{ url('stockreport') }}";
$.ajax({
    url:url1,
           method:'GET',
    dataType:"json",
    data:{
                },
    success:function(response){ 
        alert("started")
    }

});            
            
            
            
            
            var url = "{{ url('stock-vise') }}";
$.ajax({
    url:url,
           method:'GET',
    dataType:"json",
    data:{
                },
    success:function(response){
     
          var ids=1;
        var bodyData = '';
        console.log(response.var);
        document.getElementById("ts").innerHTML = response.price;
          $("#ttbody").html(""); 
        $.each(response.var,function(key,item){
            //let brv=item.item.brand.group.name;
            console.log(item.id)
     bodyData+="<tr style='height:15px;'>"
                    bodyData+="<td>"+ids+"</td><td>"+item.brand.group.name+"</td><td>"+item.brand.name+"</td><td>"+item.size+"x"+item.thikness+"</td><td>"+item.purchase1.units+"</td><td>"+item.stock.units+"</td><td>"+item.stock.price+"</td><td>"+item.stock.batch+"</td><td>"+item.stock.expiry+"</td>";
                    
                    bodyData+="</tr>";
                    ids=ids+1;
           
        })
        $("#ttbody").append(bodyData);
    }

});

        }
   


                    </script>
@endsection