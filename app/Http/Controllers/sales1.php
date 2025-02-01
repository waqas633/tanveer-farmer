<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\booker;
use App\Models\letterhead;
use App\Models\stock;
use App\Models\discount;
use App\Models\sale;
use App\Models\book;
use App\Models\salesbook;
use App\Models\transaccount;
use App\Models\salesreturn;
use App\Models\salesreturnsbook;
use Illuminate\Http\Request;
use DB;
use DataTables;
class sales1 extends Controller
{
     
    public function autopurchasecustomer(Request $request)
    {
        $uid=session('user_id');
        $pid=session('pharma_id');
          $query = $request->get('query');
          $filterResult = book::where('name', 'LIKE', '%'. $query. '%')->where('pharma_id','=',$pid)->get();
          return response()->json($filterResult);
    } 
  public function index(Request $request)
    {
         
      
      
        return view('sales1');
    }
    public function del()
    {
        $inv=$req->inv;

    }
      public function fetchrate(Request $req){
        $pros=$req->search;
        $party=$req->party;
        $discount=product::where('name', '=', $pros)->first();
        $pix=$discount['id'];
        
        $salerate=sale::where('name', '=', $pix)->where('party','=',$party)->first();
        
        $discount1=$discount['price']/$discount['pack'];
        if($salerate){
            $disc=$salerate['price']-$salerate['discount'];
            $discount1=$disc/$salerate['units'];
        }
$uid=session('user_id');
        $pid=session('pharma_id');
        
        $sid=stock::select('*')->where('pharma_id','=',$pid)->where([['name','=',$pix]])->first();
        $sids=stock::select('*')->where('pharma_id','=',$pid)->where([['name',$pix]])->get();
        $sids->load('product');
        $pros1=stock::where('name', '=', $pix)->where('pharma_id','=',$pid)->sum('units') ?? 0;
        if($sid==null){
          $batch='0';
        $expiry='0';
        $batchunits='0';
        $ppt='0';   
        }else{
        $batch=$sid['batch'];
        $expiry=$sid['expiry'];
        $batchunits=$sid['units'];
        $ppt=$sid['ppt'];
        }
        
    return response()->json([
        'batch'=>$batch,
        'expiry'=>$expiry,
        'batchunits'=>$batchunits,
        'ppt'=>$ppt,
        'pros1'=>$pros1,
        'sids'=>$sids,
        'discount'=>$discount1,
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
      sale::updateOrCreate(['id' => $request->book_id],
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
       $book = sale::find($id);
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
        $id=$req->a;
        DB::select("insert into salesreturns (SELECT * from sales where id=$id)");
      // sale::find($id)->delete();
    //  $user = sale::find($id);
     // salesreturn->$user;
     // $staff = $user->replicate();

        // make into array for mass assign. 
        //make sure you activate $guarded in your Staff model
      //  $staff = $staff->toArray();

       // salesreturn::Create($staff);
     
        return response()->json(['success'=>'Book Return successfully.']);
    }
    public function delete1(Request $req)
    {
        $id=$req->a;
       salesreturn::find($id)->delete();
     // $user = sale::find($id);
     // salesreturn->$user;
     // $staff = $user->replicate();

        // make into array for mass assign. 
        //make sure you activate $guarded in your Staff model
      //  $staff = $staff->toArray();

       // salesreturn::Create($staff);
     
        return response()->json(['success'=>'Book Deleted successfully.']);
    }
public function finalBill(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
      $inv=$req->inv;
        $party=$req->party;
        $tot=$req->tot;
        //$date=
        $disco=$req->disco;
        $cas=$req->cas;
        $netcas=$req->netcas;
        $netcas=$req->netcas;
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $time=date("h:i:sa");
$stx=salesreturn::select('*')->where('pharma_id','=',$pid)->where([['inv',$inv]])->get();
    foreach($stx as $sty){
        stock::select('*')->where('units','<=','0')->delete();
        $pname=$sty['name'];
        $produnits=$sty['units'];
        $pprice=$sty['purchase'];
        $pbatch=$sty['batch'];
        $pexpiry=$sty['expiry'];
        $result=stock::select('*')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->first();
      if($result){
          $newunits=$result['units']+$produnits;
          $newPrice=$result['price']+$pprice;
        stock::where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->update(['units'=>$newunits,'price'=>$newPrice]);
      }
      else{
         $stock=new stock;
$stock->name=$pname;
$stock->units=$produnits;
$stock->price=$pprice;
$stock->ppt=$pbatch;
$stock->batch=$pbatch;
$stock->expiry=$pexpiry;
$stock->pharma_id=$pid;
$stock->user=$uid;
$stock->save();

      } 
}
$bookid='0';
$stx2=book::Select('*')->where('name','=',$party)->get();
foreach($stx2 as $sty){
$bookid=$sty['id'];
}
        $salesbook=new salesreturnsbook;
$salesbook->id=$inv;
$salesbook->name=$bookid;
$salesbook->sale=$tot;
$salesbook->purchase=$cas;
$salesbook->discount=$disco;
$salesbook->balnce=$netcas;
$salesbook->date=$date;
$salesbook->time=$time;
$salesbook->pharma_id=$pid;
$salesbook->user=$uid;
$salesbook->save();
stock::select('*')->where('units','==','0')->delete();

    $transaccount=new transaccount;
$transaccount->name=$bookid;
$transaccount->type="Sales Return";
$transaccount->cr=($tot-$disco);
$transaccount->dr='0';
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$result=$transaccount->save();

$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }



      
 }
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = product::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 
    public function fetchstudent(Request $req){
        $uid=session('user_id');
        $pid=session('pharma_id');
        $ssid=$req->inv;
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $var=discount::where('pharma_id','=',$pid)->get();
        $sid=salesreturnsbook::all()->last();
        $sbook=salesreturnsbook::with('book')->where('pharma_id','=',$pid)->get();
        $sbook1=salesreturnsbook::with('book')->where('id',$ssid)->where('pharma_id','=',$pid)->get();
        $stx1=product::Select('name')->get();
        $booker=booker::Select('name','id')->where('pharma_id','=',$pid)->where('type','booker')->get();
        $stx2=book::Select('name')->where('pharma_id','=',$pid)->get();
        
    $stx=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)
    //->join('products','sales.name','=','products.id')
    ->get();
    $stx->load('item','item.brand','item.brand.group','books');
     $stx->load('product');
    $pros=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $disc=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    
    
    //return
    $stx3=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)
    //->join('products','sales.name','=','products.id')
    ->get();
    $stx3->load('item','item.brand','item.brand.group');
     $stx3->load('product');
    $pros1=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $disc1=salesreturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    
    return response()->json([
        'var'=>$var,
        'booker'=>$booker,
        'stx'=>$stx,
        'disc'=>$disc,
        'disc1'=>$disc1,
        'stx1'=>$stx1,
        'stx2'=>$stx2,
        'stx3'=>$stx3,
        'pros'=>round($pros,2),
        'pros1'=>round($pros1,2),
        'sid'=>$ssid,
        'sbook'=>$sbook,
        'sbook1'=>$sbook1,
    ]);
  }
     public function fetchparty(Request $req){
        $uid=session('user_id');
        $pid=session('pharma_id');
        $party=$req->party;
        $booker=book::where('name','=',$party)->where('pharma_id','=',$pid)->first();
        $area=$booker['area'];
        $refer=$booker['refer'];
    return response()->json([
        'area'=>$area,
        'refer'=>$refer,
    ]);
  }
  public function fetchstudentprint(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        
        $ltrhd=letterhead::all()->where('id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $ssid=$req->pinv;
        $sid=salesbook::where('pharma_id','=',$pid)->where('id','=',$ssid)->get();
        $sid->load('book1');
        
           // echo $ssid;
        
        //$ssid=$sid['id']+1;
    $stx=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stx->load('product');
    //echo $stx;
    $stxs=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->first();
    $party=$stxs['party'];
    echo $party;
    $party1=book::where('name', '=', $party)->where('pharma_id','=',$pid)->first();
    $pros=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $dix=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return view('salesbillprint1',[
        'var'=>$stx,
        'dix'=>$dix,
        'var1'=>$stxs,
        'stx1'=>$stx1,
        'party'=>$party,
        'price'=>round($pros,2),
        'sid'=>$ssid,
        'ltrhd'=>$ltrhd,
        'ssds'=>$sid,
    ]);
  }
  public function fetchstudentprinturdu(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        
        $ltrhd=letterhead::all()->where('id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $ssid=$req->pinv;
        $sid=salesbook::where('pharma_id','=',$pid)->where('id','=',$ssid)->get();
        $sid->load('book1');
        
            //echo $sid;
        
        //$ssid=$sid['id']+1;
    $stx=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stx->load('product');
    //echo $stx;
    $stxs=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->first();
    $party=$stxs['party'];
    $party1=book::where('name', '=', $party)->where('pharma_id','=',$pid)->first();
    $pros=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $dix=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return view('salesbillprint1urdu',[
        'var'=>$stx,
        'dix'=>$dix,
        'var1'=>$stxs,
        'stx1'=>$stx1,
        'party'=>$party,
        'price'=>round($pros,2),
        'sid'=>$ssid,
        'ltrhd'=>$ltrhd,
        'ssds'=>$sid,
    ]);
  }
  public function salemansales(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
$from = $req->date1;
$to = $req->date2;
$pros2=sale::select('booker',sale::raw('SUM(price) as cr'))
    ->whereBetween('created_at', [$from, $to])
    ->groupBy('booker')
    ->where('pharma_id','=',$pid)
    ->get();
 return response()->json([
        'pros2'=>$pros2,

    ]);
  }
   public function datesale(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        $from = $req->date1;
$to = $req->date2;
$proname=$req->proname;
$proname=$req->proname;
$cname=$req->cname;

$dated2=sale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$pros2=sale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('price');
$dated1=sale::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$pros1=sale::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('price');
$dated=sale::with('product')->whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->get();
$dated->load('product');
echo $dated;
    $pros=sale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('price');
    return response()->json([
        'dated'=>$dated,
        'dated1'=>$dated1,
        'dated2'=>$dated2,
        'pros'=>round($pros,2),
        'pros1'=>round($pros1,2),
        'pros2'=>round($pros2,2),

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
        $prxxx=$pros['id'];
        $stk=stock::select('*')->where([['name',$prxxx],['batch',$batch],['expiry',$expiry]])->where('pharma_id','=',$pid)->first();
$date=date("Y-m-d");
        $stkunits=$stk['units'];
        $nid=$pros['id'];
        $price=round($pros['price']/$pros['pack'],2);//total no use
        $pprice=round($stk['ppt']/$pros['pack'],2);//perpack
        $totalunitsprice=round($units*$price,2);//totalprice
        $saleprice=$discount*$units;//sale price
        $discountNow=0;
        if($saleprice<=$totalunitsprice){
        $discountNow=round($totalunitsprice-$saleprice);
        }
        $totalunitspprice=round($units*$pprice,2);//perpacktotal
        $totalprofit=$saleprice-$totalunitspprice;
        if($discountNow<0){
           $discountNow=0;
           $totalprofit=$totalprofit+$discountNow;
        }
        if($stkunits>$units){
        $product=new sale;
$product->name=$nid;
$product->units=$units;
$product->price=$saleprice;
$product->purchase=$totalunitspprice;
$product->profit=$totalprofit;
$product->party=$party;
$product->unitprice=$discount;
$product->batch=$batch;
$product->discount=$discountNow;
$product->created_at=$date;
$product->expiry=$expiry;
$product->inv=$inv;
$product->town=$town;
$product->booker=$booker;
$product->disage=$discount;
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
$product=new sale;
$product->name=$nid;
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
$product->disage=$discount;
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
$product=new sale;
$product->name=$nid;
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
$product->disage=$discount;
$product->user=$uid;
$product->pharma_id=$pid;
$result=$product->save();
if($result){
         return response()->json(['success'=>'Item Added successfully.']);
        }

}

    }
    
}
