@extends('layout')
@section('container')
@php
$units=0;
$amount=0;
$discount=0;
$net=0;
foreach($var as $a){
$units=$units+intval($a->units);
$discount=$discount+intval($a->discount);
$net=$net+intval($a->price);
}
@endphp
<div align="center">
<h1>Product Vise Purchase</h1>

 <table class="table table-bordered table-striped">
        <thead>
            <tr>
                   <th width="75px">Inv #</th>
                <th>Brand</th>
                <th  width="100px">Date</th>
                <th width="75px">Rate</th>
                <th width="50px">Units</th>
                <th  width="100px">Price</th>
                <th width="50px">Discount</th>
                <th  width="100px">Total Price</th>
                 <th  width="100px">Party</th>
            </tr>
        </thead>
        <tbody id="ttbody">
            @foreach($var as $a)
            <tr>
         <td>{{$a->inv}}</td>
          
            
            <td>{{$a->item->brand['name']}} {{$a->item['size']}}x{{$a->item['thikness']}}</td>
           
             <td>{{$a->created_at}}</td>
            <td>{{$a->batch}}</td>
            <td>{{$a->units}}</td>
            <td>{{$a->batch}}</td>
            <td>{{ ($a->discount !== null) ? $a->discount : 0 }}</td>
                         <td>{{$a->price}}</td>
                    <td>{{$a->books->name}}</td>  
                    </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: center"><b> Total</b></td>
                <td><b>{{$units}}</b></td>
                <td></td>
                <td><b>{{$discount}}</b></td>
                <td><b>{{$net}}</b></td>
                <td></td>
            </tr>
        </tbody>
        
        
    </table>

</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

                   
@endsection