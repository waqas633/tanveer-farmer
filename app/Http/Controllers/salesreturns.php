<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\booker;
use App\Models\stock;
use App\Models\discount;
use App\Models\sale;
use App\Models\salesreturn;
use App\Models\salesreturnsbook;
use App\Models\book;
use App\Models\salesbook;
use App\Models\transaccount;
use Illuminate\Http\Request;

class salesreturns extends Controller
{
   
  public function index(Request $request)
    {
         
      
      
        return view('salesreturn');
    }
    public function del()
    {
        $inv=$req->inv;

    }
      public function fetchrate(Request $req){
        $pros=$req->search;
        $party=$req->party;

         $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=stock::select('*')->where([['name','=',$pros]])->where('pharma_id','=',$pid)->first();
        $sids=stock::select('*')->where([['name',$pros]])->where('pharma_id','=',$pid)->get();
        $pros1=stock::where('name', '=', $pros)->sum('units')->where('pharma_id','=',$pid) ?? 0;
        
        $batch=$sid['batch'];
        $expiry=$sid['expiry'];
        $batchunits=$sid['units'];
        $ppt=$sid['ppt'];
        $discount=discount::select('*')->where('pharma_id','=',$pid)->where([['item',$pros],['party',$party]])->first() ?? 0;
    return response()->json([
        'batch'=>$batch,
        'expiry'=>$expiry,
        'batchunits'=>$batchunits,
        'ppt'=>$ppt,
        'pros1'=>$pros1,
        'sids'=>$sids,
        'discount'=>$discount,
    ]);
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      salesreturn::updateOrCreate(['id' => $request->book_id],
                ['title' => $request->title, 'author' => $request->author]);        
   
        return response()->json(['success'=>'Book saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $uid=session('user_id');
        $pid=session('pharma_id');
       $book = salesreturn::find($id)->where('pharma_id','=',$pid);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
         $uid=session('user_id');
        $pid=session('pharma_id');
        $id=$req->a;
       salesreturn::find($id)->where('pharma_id','=',$pid)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
 public function finalBill(Request $req){
     $uid=session('user_id');
        $pid=session('pharma_id');
      $inv=$req->inv;
        $party=$req->party;
        $tot=$req->tot;
        $disco=$req->disco;
        $cas=$req->cas;
        $netcas=$req->netcas;
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $time=date("h:i:sa");
$stx=salesreturn::select('*')->where([['inv',$inv]])->where('pharma_id','=',$pid)->get();
echo $stx;
    foreach($stx as $sty){
        $pname=$sty['name'];
        $produnits=$sty['units'];
        echo $pname;
        $pbatch=$sty['batch'];
        $pexpiry=$sty['expiry'];
        $result=stock::select('*')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->first();
      if($result){
        stock::select('stocks')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->increment('units',$produnits);
      }
}


        $salesbook=new salesreturnsbook;
$salesbook->id=$inv;
$salesbook->name=$party;
$salesbook->sale=$tot;
$salesbook->purchase=$cas;
$salesbook->discount=$disco;
$salesbook->balnce=$netcas;
$salesbook->date=$date;
$salesbook->time=$time;
$salesbook->user=$uid;
$salesbook->pharma_id=$pid;
$result=$salesbook->save();
stock::select('*')->where('units','==','0')->delete();
$transaccount=new transaccount;
$transaccount->name=$party;
$transaccount->type="Sales Returns";
$transaccount->cr=$tot;
$transaccount->dr=$cas;
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->user=$uid;
$transaccount->pharma_id=$pid;
$result=$transaccount->save();

if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }

      
 }


    public function fetchstudent(Request $req){
         $uid=session('user_id');
        $pid=session('pharma_id');
        $var=discount::all()->where('pharma_id','=',$pid);
        $sid=salesreturnsbook::all()->where('pharma_id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $booker=booker::Select('name')->where('pharma_id','=',$pid)->where('type','booker')->get();
        $stx2=book::Select('name')->where('pharma_id','=',$pid)->get();
        $ssid=$sid['id']+1;
    $stx=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $pros=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $disc=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return response()->json([
        'var'=>$var,
        'booker'=>$booker,
        'stx'=>$stx,
        'disc'=>$disc,
        'stx1'=>$stx1,
        'stx2'=>$stx2,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
    ]);
  }
     
  public function fetchstudentprint(Request $req){
     $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=salesreturnsbook::all()->where('pharma_id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $ssid=$sid['id']+1;
    $stx=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stxs=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->first();
    $party=$stxs['party'];
    $party1=book::where('name', '=', $party)->where('pharma_id','=',$pid)->first();
    $pros=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $dix=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return view('salesbillprint',[
        'var'=>$stx,
        'dix'=>$dix,
        'var1'=>$stxs,
        'stx1'=>$stx1,
        'party1'=>$party1,
        'price'=>round($pros,2),
        'sid'=>$ssid,
    ]);
  }

    public function calcu(Request $req){
         $uid=session('user_id');
        $pid=session('pharma_id');
        $name=$req->search;
        $units=$req->units;
        $inv=$req->inv;
        $party=$req->party;
        $batch=$req->batch;
        $expiry=$req->expiry;
        $discount=$req->disc11;
        $booker=$req->booker;
        $town=$req->town;
        $pros=product::select('*')->where([['name','=',$req->search]])->first();
        $stk=stock::select('*')->where('pharma_id','=',$pid)->where([['name',$name],['batch',$batch],['expiry',$expiry]])->first();
$date=date("Y-m-d");
        $stkunits=$stk['units'];
        $price=round($pros['price']/$pros['pack'],2);
        $pprice=round($stk['ppt']/$pros['pack'],2);
        $totalunitsprice=round($units*$price,2);
        $discountNow=round($totalunitsprice*($discount/100));
        $totalunitspprice=round($units*$pprice,2);
        $totalprofit=$totalunitsprice-$totalunitspprice-$discountNow;
        if($stkunits>$units){
        $product=new salesreturn;
$product->name=$name;
$product->units=$units;
$product->price=$totalunitsprice;
$product->purchase=$totalunitspprice;
$product->profit=$totalprofit;
$product->party=$party;
$product->unitprice=$price;
$product->batch=$batch;
$product->discount=$discountNow;
$product->created_at=$date;
$product->expiry=$expiry;
$product->inv=$inv;
$product->town=$town;
$product->booker=$booker;
$product->user=$uid;
$product->pharma_id=$pid;
$result=$product->save();
if($result){
         return response()->json(['success'=>'item Added successfully.']);
        }
  
}else{

   $stk1=stock::select('*')->where([['name',$name]])->where('pharma_id','=',$pid)->skip(1)->first();
$stkunits=$stk['units'];
$newunits=$units-$stkunits;
        $price=round($pros['price']/$pros['pack'],2);
        $pprice=round($stk['ppt']/$pros['pack'],2);
        $totalunitsprice=round($stkunits*$price,2);
        $totalunitspprice=round($stkunits*$pprice,2);
        $totalprofit=$totalunitsprice-$totalunitspprice;
$product=new salesreturn;
$product->name=$name;
$product->units=$stkunits;
$product->created_at=$date;
$product->price=$totalunitsprice;
$product->purchase=$totalunitspprice;
$product->profit=$totalprofit;
$product->party=$party;
$product->unitprice=$price;
$product->batch=$batch;
$product->expiry=$expiry;
$product->inv=$inv;
$product->discount=$discountNow;
$product->town=$town;
$product->booker=$booker;
$product->user=$uid;
$product->pharma_id=$pid;
$product->save();


        $batch1=$stk1['batch'];
        $expiry1=$stk1['expiry'];
        $stkunits1=$stk1['units'];
        $price1=round($pros['price']/$pros['pack'],2);
        $pprice1=round($stk1['ppt']/$pros['pack'],2);
        $totalunitsprice1=round($newunits*$price,2);
        $totalunitspprice1=round($newunits*$pprice,2);
        $totalprofit1=$totalunitsprice-$totalunitspprice;
$product=new salesreturn;
$product->name=$name;
$product->units=$newunits;
$product->price=$totalunitsprice1;
$product->purchase=$totalunitspprice1;
$product->profit=$totalprofit1;
$product->party=$party;
$product->unitprice=$price;
$product->batch=$batch1;
$product->created_at=$date;
$product->expiry=$expiry1;
$product->inv=$inv;
$product->discount=$discountNow;
$product->town=$town;
$product->booker=$booker;
$product->user=$uid;
$product->pharma_id=$pid;
$result=$product->save();
if($result){
         return response()->json(['success'=>'Item Added successfully.']);
        }

}

    }
}
