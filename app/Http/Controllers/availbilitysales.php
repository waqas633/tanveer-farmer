<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\booker;
use App\Models\letterhead;
use App\Models\stock;
use App\Models\discount;
use App\Models\availbilitysale;
use App\Models\book;
use App\Models\availbilitybook;
use App\Models\transaccount;
use Illuminate\Http\Request;
use DB;
use DataTables;
class availbilitysales extends Controller
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
         
      
      
        return view('availbility');
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
$uid=session('user_id');
        $pid=session('pharma_id');
        
        $sid=stock::select('*')->where('pharma_id','=',$pid)->where([['name','=',$pros]])->first();
        $sids=stock::select('*')->where('pharma_id','=',$pid)->where([['name',$pros]])->get();
        $pros1=stock::where([['name',$pros]])->where('pharma_id','=',$pid)->sum('units') ?? 0;
        
        $batch=$sid['batch'];
        $expiry=$sid['expiry'];
        $batchunits=$sid['units'];
        $ppt=$sid['ppt'];
        $ptp=$discount['price']/$discount['pack'];
        $discount=discount::select('*')->where('pharma_id','=',$pid)->where([['item',$pros],['party',$party]])->first() ?? 0;
    return response()->json([
        'batch'=>$batch,
        'expiry'=>$expiry,
        'batchunits'=>$batchunits,
        'ppt'=>$ppt,
        'pros1'=>$pros1,
        'sids'=>$sids,
        'discount'=>$discount,
        'ptp'=>$ptp,
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
       availbilitysale::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
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
        $date=$req->date;
        $time=date("h:i:sa");
$stx=availbilitysale::select('*')->where('pharma_id','=',$pid)->where([['inv',$inv]])->get();
    foreach($stx as $sty){
        $pname=$sty['name'];
        $produnits=$sty['units'];
        $pprice=$sty['purchase'];
        $pbatch=$sty['batch'];
        $pexpiry=$sty['expiry'];
        $result=stock::select('*')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->first();
      if($result){
          $newunits=$result['units']-$produnits;
          $newPrice=$result['price']-$pprice;
        stock::where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->update(['units'=>$newunits,'price'=>$newPrice]);
      }
}
$bookid='0';
$stx2=book::Select('*')->where('name','=',$party)->get();
foreach($stx2 as $sty){
$bookid=$sty['id'];
}
        $salesbook=new availbilitybook;
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
if($cas=='0'){
$transaccount=new transaccount;
$transaccount->name=$bookid;
$transaccount->type="Availbility";
$transaccount->cr='0';
$transaccount->dr=($tot-$disco);
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
}else{
    $transaccount=new transaccount;
$transaccount->name=$bookid;
$transaccount->type="Availbility";
$transaccount->cr='0';
$transaccount->dr=($tot-$disco);
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$result=$transaccount->save();
 $transaccount=new transaccount;
$transaccount->name=$bookid;
$transaccount->type="Recovery";
$transaccount->cr=($tot-$disco);
$transaccount->dr='0';
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
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
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $var=discount::where('pharma_id','=',$pid)->get();
        $sid=availbilitybook::all()->last();
        $sbook=availbilitybook::with('book1')->where('status','0')->where('pharma_id','=',$pid)->get();
        $stx1=product::Select('name')->get();
        $booker=booker::Select('name','id')->where('pharma_id','=',$pid)->where('type','booker')->get();
        $stx2=availbilitybook::Select('name')->where('pharma_id','=',$pid)->get();
        $ssid=$sid['id']+1;
    $stx=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)
    
    //->join('products','sales.name','=','products.id')
    ->get();
     $stx->load('item','item.brand','item.brand.group','availbilitybooks');
    
    $pros=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $disc=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return response()->json([
        'var'=>$var,
        'booker'=>$booker,
        'stx'=>$stx,
        'disc'=>$disc,
        'stx1'=>$stx1,
        'stx2'=>$stx2,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
        'sbook'=>$sbook,
    ]);
  }
     public function fetchstudentavailable(Request $req){
        $uid=session('user_id');
        $pid=session('pharma_id');
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $var=discount::where('pharma_id','=',$pid)->get();
        $sid=availbilitybook::all()->last();
        $sbook=availbilitybook::with('book1')->where('status','0')->where('pharma_id','=',$pid)->get();
        $stx1=product::Select('name')->get();
        $booker=booker::Select('name','id')->where('pharma_id','=',$pid)->where('type','booker')->get();
        $stx2=book::Select('name')->where('pharma_id','=',$pid)->get();
        $ssid=$sid['id']+1;
    $stx=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)
    
    //->join('products','sales.name','=','products.id')
    ->get();
     $stx->load('item','item.brand','item.brand.group','books');
    
    $pros=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $disc=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return response()->json([
        'var'=>$var,
        'booker'=>$booker,
        'stx'=>$stx,
        'disc'=>$disc,
        'stx1'=>$stx1,
        'stx2'=>$stx2,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
        'sbook'=>$sbook,
    ]);
  }
     public function fetchparty(Request $req){
        $uid=session('user_id');
        $pid=session('pharma_id');
        $party=$req->party;
        $booker=book::where('name','=',$party)->where('pharma_id','=',$pid)->first();
        $area=$booker['address'];
        $refer=$booker['phone'];
    return response()->json([
        'area'=>$area,
        'refer'=>$refer,
    ]);
  }
  public function fetchstudentprint(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=availbilitybook::all()->where('pharma_id','=',$pid)->last();
        $ltrhd=letterhead::all()->where('id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $ssid=$req->pinv;
        //$ssid=$sid['id']+1;
    $stx=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stx->load('item','item.brand','item.brand.group');
    $stxs=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->first();
    $party=$stxs['party'];
    $pdate=$stxs['date'];
    echo $pdate;
    $party1=book::where('id', '=', $party)->where('pharma_id','=',$pid)->first();
    
   // DB::table('transaccounts')->select(DB::raw("'SUM'(cr), DB::raw("'sum'(dr))->where('name','=','9')->get();
    $balance=transaccount::select(DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))->where('name','=',$party)->where('pharma_id','=',$pid)->where('inv','!=',$ssid)->get();
        $balance1=transaccount::select(DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))->where('name','=',$party)->where('pharma_id','=',$pid)->get();
    $pros=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $dix=availbilitysale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return view('availbilitybillprint1',[
        'var'=>$stx,
        'dix'=>$dix,
        'var1'=>$stxs,
        'stx1'=>$stx1,
        'party'=>$party,
        'party1'=>$party1,
        'price'=>round($pros,2),
        'sid'=>$ssid,
        'ssds'=>$sid,
        'ltrhd'=>$ltrhd,
        'balance'=>$balance,
        'balance1'=>$balance1,
    ]);
  }
  public function salemansales(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
$from = $req->date1;
$to = $req->date2;
$pros2=availbilitysale::select('booker',sale::raw('SUM(price) as cr'))
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
$cname=$req->cname;
$pix=0;
$pis=product::where('name','=',$proname)->get();
foreach($pis as $hits){
    $pix=$hits['id'];
}

$dated2=availbilitysale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$dated2->load('item','item.brand','item.brand.group');
$pros2=availbilitysale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('price');
$pros2z=availbilitysale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('discount');
$dated1=availbilitysale::where('name', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$dated1->load('item','item.brand','item.brand.group','books');
$pros1=availbilitysale::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('price');
$pros1z=availbilitysale::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('discount');
$dated=availbilitysale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->get();
$dated->load('item','item.brand','item.brand.group');
    $pros=availbilitysale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('price');
    $prosz=availbilitysale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('discount');
    $pros=availbilitysale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('price');
    $unitz=availbilitysale::whereBetween('created_at', [$from, $to])->where('name', '=', $proname)->where('pharma_id','=',$pid)->sum('units');
        $stk=stock::where('name', '=', $proname)->where('pharma_id','=',$pid)->sum('units');
    return response()->json([
        'dated'=>$dated,
        'dated1'=>$dated1,
        'dated2'=>$dated2,
        'pros'=>round($pros,2),
        'prosz'=>round($prosz,2),
        'pros1'=>round($pros1,2),
        'pros1z'=>round($pros1z,2),
        'pros2'=>round($pros2,2),
        'unitz'=>round($unitz,2),
        'stk'=>$stk,
'pros2z'=>round($pros2z,2),
    ]);

  }
    public function calcus(Request $req){
        $uid=session('user_id');
        $pid=session('pharma_id');
        $name=$req->search;
        $units=$req->units;
        $uprice=$req->uprice;
        $inv=$req->inv;
        $party=$req->party;
        $psid=book::select('*')->where([['name','=',$party]])->first();
        //$prid=$sid['id'];
        $psrid=$psid['id'];
        //$batch=$req->batch;
        //$expiry=$req->expiry;
        $discount=$req->disc11;
        $booker=$req->booker;
        $town=$req->town;
        //$pros=product::select('*')->where([['name','=',$req->search]])->first();
        //$prxxx=$pros['id'];
        $stk=stock::select('*')->where([['name',$req->search]])->where('pharma_id','=',$pid)->first();
$date=date("Y-m-d");
        $stkunits=$stk['units'];
        $batch=$stk['batch'];
        $expiry=$uprice;
       // $nid=$pros['id'];
        //$price=round($pros['price']/$pros['pack'],2);
        $pprice=round($stk['batch'],2);
        $totalunitsprice=round($units*$uprice,2);
        $discountNow=round($totalunitsprice*($discount/100));
        $totalunitspprice=round($units*$pprice,2);
        $totalprofit=$totalunitsprice-$totalunitspprice-$discountNow;
        if($stkunits>=$units){
        $product=new availbilitysale;
$product->name=$req->search;
$product->units=$units;
$product->price=$totalunitsprice;
$product->purchase=$totalunitspprice;
$product->profit=$totalprofit;
$product->party=$psrid;
$product->unitprice=$uprice;
$product->batch=$batch;
$product->discount=$discountNow;
$product->created_at=$req->date;
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
        $price=round($stk1['expiry'],2);
        $pprice=round($stk1['batch'],2);
          
       // $totalunitspprice=round($units*$pprice,2);
        //$totalprofit=$totalunitsprice-$totalunitspprice-$discountNow;
        $totalunitsprice=round($stkunits*$uprice,2);
        $totalunitspprice=round($stkunits*$pprice,2);
        $discountNow=round($totalunitsprice*($discount/100));
       $totalprofit=$totalunitsprice-$totalunitspprice-$discountNow;
$product=new availbilitysale;
$product->name=$req->search;
$product->units=$stkunits;
$product->created_at=$date;
$product->price=$totalunitsprice;
$product->purchase=$totalunitspprice;
$product->profit=$totalprofit;
$product->party=$psrid;
$product->unitprice=$uprice;
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
        $price1=round($stk1['expiry'],2);;
        $pprice1=round($stk1['batch'],2);;
        $totalunitsprice1=round($newunits*$uprice,2);
        $discountNow=round($totalunitsprice1*($discount/100));
        $totalunitspprice1=round($newunits*$pprice1,2);
        $totalprofit1=$totalunitsprice1-$totalunitspprice1-$discountNow;
$product=new availbilitysale;
$product->name=$req->search;
$product->units=$newunits;
$product->price=$totalunitsprice1;
$product->purchase=$totalunitspprice1;
$product->profit=$totalprofit1;
$product->party=$psrid;
$product->unitprice=$uprice;
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
     public function deleteinvoice(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        date_default_timezone_set("Asia/Karachi");
        $date=$req->date;
        $time=date("h:i:sa");
        $inv=$req->pinv;
$stx=availbilitysale::select('*')->where('pharma_id','=',$pid)->where([['inv',$inv]])->get();
    foreach($stx as $sty){
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
$stock->ppt=$pprice;
$stock->batch=$sty['batch'];
$stock->expiry=$sty['expiry'];
$stock->pharma_id=$pid;
$stock->user=$uid;
$stock->save();
      }
      
}
availbilitysale::where('inv',$inv)->delete();
availbilitybook::where('id',$inv)->delete();
$result=transaccount::where([['type','Availbility'],['inv',$inv]])->delete();
if($result){
         return response()->json(['success'=>'Availbility Deleted successfully.']);
        }



      
 }
    
}
