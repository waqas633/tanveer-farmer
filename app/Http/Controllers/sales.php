<?php

namespace App\Http\Controllers;
use App\Models\account;
use App\Models\accountType;
use App\Models\localsale;
use App\Models\product;
use App\Models\booker;
use App\Models\letterhead;
use App\Models\rate;
use App\Models\stock;
use App\Models\discount;
use App\Models\sale;
use App\Models\book;
use App\Models\recovery;
use App\Models\salesbook;
use App\Models\transaccount;
use App\Models\salesreturn;
use App\Models\wholesale;
use Illuminate\Http\Request;
use DB;
use DataTables;
class sales extends Controller
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
      date_default_timezone_set("Asia/Karachi");
      $date=date("Y-m-d");
      $acc_type=accountType::all();
      $ratz=rate::all();
      $accs=transaccount::select('name',DB::raw('SUM(cr) - SUM(dr) as balance'))->with('book')
                   ->groupBy('name')
                   ->get();
      $date=rate::where("date",$date)->first();
      return view('wholesales',['acc_type'=>$acc_type,'ratz'=>$ratz,'accs'=>$accs,'datrate'=>$date]);
    }
    public function index1(Request $request)
    {
      date_default_timezone_set("Asia/Karachi");
      $date=date("Y-m-d");
      $acc_type=accountType::all();
      $ratz=rate::all();
      $wholesaless=wholesale::where("date",$date)->with('pbook')->with('rbook')->get();
      $accs=transaccount::select('name',DB::raw('SUM(cr) - SUM(dr) as balance'))->with('book')
                   ->groupBy('name')
                   ->get();
      $date=rate::where("date",$date)->first();
      return view('localsales',['acc_type'=>$acc_type,'ratz'=>$ratz,'accs'=>$accs,'datrate'=>$date,'wholesaless'=>$wholesaless]);
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
        $transaccount=transaccount::where('type','WholeSales')->where('inv',$id)->delete();
       $result=wholesale::find($id)->delete();
     if($result){
        return response()->json(['success'=>'Book deleted successfully.']);
     }else{
      return response()->json(['success'=> 'No Record To delete']);
     }
    }
    public function deleteLocalSale(Request $req)
    {
        $id=$req->a;
        $result=localsale::find($id)->delete();
       $transaccount=transaccount::where('type','LocalSalesReceiving')->where('inv',$id)->first();
       $transaccount->delete();
       $transaccount1=transaccount::where('type','LocalSales')->where('inv',$id)->first();
       $transaccount1->delete();
     if($result){
        return response()->json(['success'=>'Book deleted successfully.']);
     }else{
      return response()->json(['success'=> 'No Record To delete']);
     }
    }
    public function saverate(Request $req){
      $id=$req->strt;
      $end=$req->endt;
      $date=date("Y-m-d");
      $find=rate::where('date', $date)->first();
      if($find){
      $find->open=$id;
      $find->close=$end;
      $find->date=$date;
      $result=$find->save();
      if($result){
        return response()->json(['success'=>'Rates Updated successfully.']);
     }else{
      return response()->json(['success'=> 'Not Add']);
     }
      }else{
      $rates=new rate;
      $rates->open=$id;
      $rates->close=$end;
      $rates->date=$date;
      $result=$rates->save();
      if($result){
        return response()->json(['success'=>'Rates Added successfully.']);
     }else{
      return response()->json(['success'=> 'Not Add']);
     }
    }
    }
//  public function finalBill(Request $req){
//     $uid=session('user_id');
//         $pid=session('pharma_id');
//       $inv=$req->inv;
//         $party=$req->party;
//         $tot=$req->tot;
//         //$date=
//         $disco=$req->disco;
//         $cas=$req->cas;
//         $netcas=$req->netcas;
//         $netcas=$req->netcas;
//         date_default_timezone_set("Asia/Karachi");
//         $date=$req->date;
//         $time=date("h:i:sa");
// $stx=sale::select('*')->where('pharma_id','=',$pid)->where([['inv',$inv]])->get();
//     foreach($stx as $sty){
//         stock::select('*')->where('units','<=','0')->delete();
//         $pname=$sty['name'];
//         $produnits=$sty['units'];
//         $pprice=$sty['purchase'];
//         $pbatch=$sty['batch'];
//         $pexpiry=$sty['expiry'];
//         $result=stock::select('*')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->first();
//       if($result){
//           $newunits=$result['units']-$produnits;
//           $newPrice=$result['price']-$pprice;
//         stock::where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->update(['units'=>$newunits,'price'=>$newPrice]);
//       }
//       else{
//          $stock=new stock;
// $stock->name=$pname;
// $stock->units="-".$produnits;
// $stock->price="-".$pprice;
// $stock->ppt=$pbatch;
// $stock->batch=$pbatch;
// $stock->expiry=$pexpiry;
// $stock->pharma_id=$pid;
// $stock->user=$uid;
// $stock->save();

//       } 
// }
// $bookid='0';
// $stx2=book::Select('*')->where('name','=',$party)->get();
// foreach($stx2 as $sty){
// $bookid=$sty['id'];
// }
//         $salesbook=new salesbook;
// $salesbook->id=$inv;
// $salesbook->name=$bookid;
// $salesbook->sale=$tot;
// $salesbook->purchase=$cas;
// $salesbook->discount=$disco;
// $salesbook->balnce=$netcas;
// $salesbook->date=$date;
// $salesbook->time=$time;
// $salesbook->pharma_id=$pid;
// $salesbook->user=$uid;
// $salesbook->save();
// stock::select('*')->where('units','==','0')->delete();
// if($cas=='0'){
// $transaccount=new transaccount;
// $transaccount->name=$bookid;
// $transaccount->type="Sales";
// $transaccount->cr='0';
// $transaccount->dr=($tot-$disco);
// $transaccount->date=$date;
// $transaccount->inv=$inv;
// $transaccount->pharma_id=$pid;
// $transaccount->user=$uid;
// $result=$transaccount->save();
// if($result){
//          return response()->json(['success'=>'Book saved successfully.']);
//         }
// }else{
//     $transaccount=new transaccount;
// $transaccount->name=$bookid;
// $transaccount->type="Sales";
// $transaccount->cr='0';
// $transaccount->dr=($tot-$disco);
// $transaccount->date=$date;
// $transaccount->inv=$inv;
// $transaccount->pharma_id=$pid;
// $transaccount->user=$uid;
// $result=$transaccount->save();
//  $product=new recovery;
//         $product->date=$date;
// $product->name=$bookid;
// $product->details="Cash Recived against sale Invoice #".$inv;
// $product->amount=$cas;
// $product->pharma_id=$pid;
// $product->user=$uid;
// $product->save();
//  $transaccount=new transaccount;
// $transaccount->name=$bookid;
// $transaccount->type="Recovery";
// $transaccount->cr=$cas;
// $transaccount->dr='0';
// $transaccount->date=$date;
// $transaccount->inv=$product->id;
// $transaccount->pharma_id=$pid;
// $transaccount->bank_type='1';
// $transaccount->user=$uid;
// $result=$transaccount->save();
// if($result){
//          return response()->json(['success'=>'Book saved successfully.']);
//         }
// }


      
//  }
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
          $var=wholesale::where("date",$date)->with('pbook')->with('rbook')->get();    
    return response()->json([
        'var'=>$var,
    ]);
  }
  public function fetchwholesaledatewise(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    date_default_timezone_set("Asia/Karachi");
    // $date=date("Y-m-d");  
    $startDate = $req->startDate; // Example start date
$endDate = $req->endDate; // Example end date
      // $var=wholesale::where("date",$date)->with('pbook')->with('rbook')->get(); 
      $var = Wholesale::whereBetween("date", [$startDate, $endDate])
      // ->orderBy('fid')
                ->with('pbook')
                ->with('rbook')
                ->get();   
return response()->json([
    'var'=>$var,
]);
}
public function fetchlocalsaledatewise(Request $req){
  $uid=session('user_id');
  $pid=session('pharma_id');
  date_default_timezone_set("Asia/Karachi");
  $date=date("Y-m-d");
  $startDate = $req->startDate; // Example start date
$endDate = $req->endDate; // Example end date
  // return $date;
  // $inv=$req->inv;  
    $var=localsale::whereBetween("date", [$startDate, $endDate])->with('pbook')->with('rbook')->get();  
    $var1=localsale::selectRaw('SUM(weight) as total_weight, date, tweight,tprice')
    ->whereBetween("date", [$startDate, $endDate])
    ->groupBy('date', 'tweight')
    ->get();
return response()->json([
  'var'=>$var,
  'var1'=>$var1,
]);
}
public function fetchlocalsalesummary(Request $req){
  $uid=session('user_id');
  $pid=session('pharma_id');
  date_default_timezone_set("Asia/Karachi");
  $date=date("Y-m-d");
  $startDate = $req->startDate; // Example start date
$endDate = $req->endDate; // Example end date
  // return $date;
  // $inv=$req->inv;  
    // $var=localsale::whereBetween("date", [$startDate, $endDate])->with('pbook')->with('rbook')->get();  
    $var=localsale::selectRaw('SUM(weight) as total_weight,SUM(pamount) as purchase,SUM(profit) as profit, date, tweight,tprice')
   ->whereBetween("date", [$startDate, $endDate])
    ->groupBy('date')   ->get();
return response()->json([
  'var'=>$var,
]);
}
public function getSaleUpdate(Request $req){
$inv=$req->a;
$entry=wholesale::with('pbook','rbook')->where('id', $inv)->first();
//$blnc1=wholesale::getBalanceForName($entry['fid']);
$form_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['fid'])->get();
$pur_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['pid'])->get();
return response()->json(['singleEntry'=>$entry,'form_balance'=>$form_balance,'pur_balance'=>$pur_balance]);
}
public function getLocalSaleUpdate(Request $req){
  $inv=$req->a;
  $entry=localsale::with('pbook','rbook')->where('id', $inv)->first();
  //$blnc1=wholesale::getBalanceForName($entry['fid']);
  $form_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['purchaser'])->get();
  $pur_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['van'])->get();
  return response()->json(['singleEntry'=>$entry,'form_balance'=>$form_balance,'pur_balance'=>$pur_balance]);
  }
public function updateWholeSale(Request $req){
  $uid=session('user_id');
  $pinv=$req->pinv;
  $fid=$req->fid;
  $pid=session('pharma_id');
  $purid=$req->purid;
  $van=$req->van;
  $weight=$req->weight;
  $formerrate=$req->formerrate;
  $formeramount=$req->formeramount;
  $purchaserrate=$req->purchaserrate;
  $purchaseramount=$req->purchaseramount;
  $date=$req->date;
  $stock = wholesale::where('id', $pinv)->first();
  if($stock){
//`id`, `van`, `weight`, `fid`, `frate`, `famount`, `pid`, `prate`, `pamount`, `profit`, `date`, `time`, `rates` FROM `wholesales`
$stock->van=$van;
$stock->weight=$weight;
$stock->fid=$fid;
$stock->frate=$formerrate;
$stock->famount=$formeramount;
$stock->pid=$purid;
$stock->prate=$purchaserrate;
$stock->pamount=$purchaseramount;
$stock->profit=$purchaseramount-$formeramount;
$stock->date=$date;
$stock->time='';
$stock->rates=$purchaserrate."-".$formerrate;
$stock->pharma_id=$pid;
$stock->uid=$uid;
$stock->save();
$transaccount = Transaccount::where('type', 'WholeSales')
                            ->where('inv', $pinv)->first();
$transaccount->name=$fid;
$transaccount->cr=$formeramount;
$transaccount->date=$date;
$transaccount->save();
$transaccount1 = Transaccount::where('type', 'WholeSales')
                            ->where('inv', $pinv)
                            ->offset(1)
                            ->limit(1)
                            ->first();
// $transaccount=new transaccount;
$transaccount1->name=$purid;
$transaccount1->dr=$purchaseramount;
$transaccount1->date=$date;
$result=$transaccount1->save();
if($result){
  return response()->json(['success'=>'Sale Updated successfully.']);
  }
  else{
    return response()->json(['success'=>'Unable to update.']);
  }
}else{
  return response()->json(['success'=>'No Record Founded.']);
  }
    
}
  public function fetchstudent1(Request $req){
//     $uid=session('user_id');
//     $pid=session('pharma_id');
//     date_default_timezone_set("Asia/Karachi");
//     $date=date("Y-m-d");
//     // return $date;
//     // $inv=$req->inv;  
//       $var=localsale::where("date",$date)->with('pbook')->with('rbook')->get();    
// return response()->json([
//     'var'=>$var,
// ]);
//values
 $uid=session('user_id');
        $pid=session('pharma_id');
        date_default_timezone_set("Asia/Karachi");
        $date=$req->inv;  
        
          $var=wholesale::where("date",$date)->with('pbook')->with('rbook')->get();    
    return response()->json([
        'var'=>$var,
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
    $stx=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)
    
    //->join('products','sales.name','=','products.id')
    ->get();
     $stx->load('item','item.brand','item.brand.group','books');
    
    $pros=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $disc=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
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
        $sid=salesbook::all()->where('pharma_id','=',$pid)->last();
        $ltrhd=letterhead::all()->where('id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $ssid=$req->pinv;
        //$ssid=$sid['id']+1;
    $stx=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stx->load('item','item.brand','item.brand.group');
    $stxs=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->first();
    $party=$stxs['party'];
    $pdate=$stxs['date'];
    echo $pdate;
    $party1=book::where('id', '=', $party)->where('pharma_id','=',$pid)->first();
    
   // DB::table('transaccounts')->select(DB::raw("'SUM'(cr), DB::raw("'sum'(dr))->where('name','=','9')->get();
    $balance=transaccount::select(DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))->where('name','=',$party)->where('pharma_id','=',$pid)->where('inv','!=',$ssid)->get();
        $balance1=transaccount::select(DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))->where('name','=',$party)->where('pharma_id','=',$pid)->get();
    $pros=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $dix=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return view('salesbillprint1',[
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
    public function fetchstudentprint1(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=salesbook::all()->where('pharma_id','=',$pid)->last();
        $ltrhd=letterhead::all()->where('id','=',$pid)->last();
        $stx1=product::Select('name')->get();
        $ssid=$req->pinv;
        //$ssid=$sid['id']+1;
    $stx=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stx->load('item','item.brand','item.brand.group');
    $stxs=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->first();
    $party=$stxs['party'];
    $pdate=$stxs['date'];
    echo $pdate;
    $party1=book::where('id', '=', $party)->where('pharma_id','=',$pid)->first();
    
   // DB::table('transaccounts')->select(DB::raw("'SUM'(cr), DB::raw("'sum'(dr))->where('name','=','9')->get();
    $balance=transaccount::select(DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))->where('name','=',$party)->where('pharma_id','=',$pid)->where('inv','!=',$ssid)->get();
        $balance1=transaccount::select(DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))->where('name','=',$party)->where('pharma_id','=',$pid)->get();
    $pros=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('price');
    $dix=sale::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('discount');
    return view('salesbillprint2',[
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
$pros2=sale::select('booker',sale::raw('SUM(price) as cr'))
    ->whereBetween('created_at', [$from, $to])
    ->groupBy('booker')
    ->where('pharma_id','=',$pid)
    ->get();
 return response()->json([
        'pros2'=>$pros2,

    ]);
  }
  public function datesaleview(Request $req){
         $uid=session('user_id');
        $pid=session('pharma_id');
        $cname=$req->pid;//salesreturn.php
        $dated2=sale::where('name', '=', $cname)->where('pharma_id','=',$pid)->get();
        $dated2->load('item','item.brand','item.brand.group','books');
        $dated3=salesreturn::where('name', '=', $cname)->where('pharma_id','=',$pid)->get();
        $dated3->load('item','item.brand','item.brand.group','books');
        return view('productvisesalesview',['var'=>$dated2,'var1'=>$dated3]);
        
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

$dated2=sale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$dated2->load('item','item.brand','item.brand.group');
$pros2=sale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('price');
$pros2z=sale::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('discount');
$dated1=sale::where('name', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$dated1->load('item','item.brand','item.brand.group','books');
$pros1=sale::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('price');
$pros1z=sale::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('discount');
$dated=sale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->get();
$dated->load('item','item.brand','item.brand.group');
    $pros=sale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('price');
    $prosz=sale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('discount');
    $pros=sale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('price');
    $profit=sale::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('profit');
    $unitz=sale::whereBetween('created_at', [$from, $to])->where('name', '=', $proname)->where('pharma_id','=',$pid)->sum('units');
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
        'profit'=>round($profit,2),
        'unitz'=>round($unitz,2),
        'stk'=>$stk,
'pros2z'=>round($pros2z,2),
    ]);

  }
    public function calcu(Request $req){
      // fid:fid,
      // purid:purid,
      // van:van,
      // weight:pweight,
      // formerrate:formerrate,
      // formeramount:formeramount,
      // purchaserrate:purchaserrate,
      // purchaseramount:purchaseramount,


        $uid=session('user_id');
        $fid=$req->fid;
        $pid=session('pharma_id');
        $purid=$req->purid;
        $van=$req->van;
        $weight=$req->weight;
        //$inv=$req->inv;
        $formerrate=$req->formerrate;
        $formeramount=$req->formeramount;
        $purchaserrate=$req->purchaserrate;
        $purchaseramount=$req->purchaseramount;
        $date=$req->date;
        $stock=new wholesale;
//`id`, `van`, `weight`, `fid`, `frate`, `famount`, `pid`, `prate`, `pamount`, `profit`, `date`, `time`, `rates` FROM `wholesales`
$stock->van=$van;
$stock->weight=$weight;
$stock->fid=$fid;
$stock->frate=$formerrate;
$stock->famount=$formeramount;
$stock->pid=$purid;
$stock->prate=$purchaserrate;
$stock->pamount=$purchaseramount;
$stock->profit=$purchaseramount-$formeramount;
$stock->date=$date;
$stock->time='';
$stock->rates=$purchaserrate."-".$formerrate;
$stock->pharma_id=$pid;
$stock->uid=$uid;
$stock->save();
$inv=$stock->id;
$transaccount=new transaccount;
$transaccount->name=$fid;
$transaccount->type="WholeSales";
$transaccount->cr=$formeramount;
$transaccount->dr="0";
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$transaccount->bank_type=0;
$transaccount->save();
$transaccount=new transaccount;
$transaccount->name=$purid;
$transaccount->type="WholeSales";
$transaccount->dr=$formeramount;
$transaccount->cr="0";
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$transaccount->bank_type=0;
$result=$transaccount->save();
$balance=transaccount::select([transaccount::raw("SUM(dr) as total_debit"), transaccount::raw("SUM(cr) as total_credit")])->where('name', $fid)->where('pharma_id','=',$pid)->get();
if($result){
         return response()->json(['success'=>'Book saved successfully.','balance'=>'$balance']);
        }

 }
 public function add_localsales(Request $req){
  $sale_rate=$req->formerrate;
    $buyrate=$req->purchaserrate;
    $van=$req->van;
    $weight=$req->pweight;
    $formeramount=$req->formeramount;
    $uid=session('user_id');
    $fid=$req->purid;
    $pid=session('pharma_id');
    $date=$req->date;
    $former_open=$req->former_open;
    $former_close=$req->former_close;
    $recovery_amount=$req->recovery_amount;
    $total_weight=$req->total_weight;
    $total_amount=$req->weight_amount;
    $diff=$sale_rate-$buyrate;
    $profit=$diff*$weight;
  $stock=new localsale;
  $stock->van=$van;
  $stock->weight=$weight;
  $stock->purchaser=$fid;
  $stock->prate=$sale_rate;
  $stock->pamount=$formeramount;
  $stock->profit=$profit;
  $stock->date=$date;
  $stock->time='';
  $stock->rates=$sale_rate."-".$buyrate;
  $stock->Open=$former_open;
  $stock->Close=$former_close;
  $stock->recivings=$recovery_amount;
  $stock->tweight=$total_weight;
  $stock->tprice=$total_amount;
  $stock->pharma_id=$pid;
  $stock->uid=$uid;
  $stock->save();
  $inv=$stock->id;
  $transaccount=new transaccount;
$transaccount->name=$fid;
$transaccount->type="LocalSales";
$transaccount->dr=$formeramount;
$transaccount->cr="0";
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$transaccount->bank_type=0;
$result=$transaccount->save();
if($recovery_amount>0){
$transaccount=new transaccount;
$transaccount->name=$fid;
$transaccount->type="LocalSalesReceiving";
$transaccount->dr="0";
$transaccount->cr=$recovery_amount;
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$transaccount->bank_type=0;
$result=$transaccount->save();
}
if($result){
     return response()->json(['success'=>'Book saved successfully.']);
    }

}
public function updateLocalSale(Request $req){
  $sale_rate=$req->formerrate;
    $buyrate=$req->purchaserrate;
    $van=$req->van;
    $pinv=$req->pinv;
    $weight=$req->pweight;
    $formeramount=$req->formeramount;
    $uid=session('user_id');
    $fid=$req->purid;
    $pid=session('pharma_id');
    $date=$req->date;
    $former_open=$req->former_open;
    $former_close=$req->former_close;
    $recovery_amount=$req->recovery_amount;
    $total_weight=$req->total_weight;
    $total_amount=$req->weight_amount;
    $diff=$sale_rate-$buyrate;
    $profit=$diff*$weight;
 // $stock=new localsale;
 $stock=localsale::find($pinv);
 $stock->van=$van;
  $stock->weight=$weight;
  $stock->purchaser=$fid;
  $stock->prate=$sale_rate;
  $stock->pamount=$formeramount;
  $stock->profit=$profit;
  $stock->date=$date;
  $stock->time='';
  $stock->rates=$sale_rate."-".$buyrate;
  $stock->Open=$former_open;
  $stock->Close=$former_close;
  $stock->recivings=$recovery_amount;
  $stock->tweight=$total_weight;
  $stock->tprice=$total_amount;
  $stock->pharma_id=$pid;
  $stock->uid=$uid;
  $stock->update();
  $transaccount=transaccount::where('type','LocalSales')->where('inv',$pinv)->first();
$transaccount->dr=$formeramount;
$transaccount->date=$date;
$result=$transaccount->save();
if($recovery_amount=="0"){
  $transaccount=transaccount::where('type','LocalSalesReceiving')->where('inv',$pinv)->first();
  $result=$transaccount->delete();
}
if($recovery_amount>0){
  
  $transaccount=transaccount::where('type','LocalSalesReceiving')->where('inv',$pinv)->first();
  if($transaccount){
$transaccount->cr=$recovery_amount;
$transaccount->date=$date;
$result=$transaccount->save();
  }else{
    $transaccount=new transaccount;
$transaccount->name=$fid;
$transaccount->type="LocalSalesReceiving";
$transaccount->dr="0";
$transaccount->cr=$recovery_amount;
$transaccount->date=$date;
$transaccount->inv=$pinv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$transaccount->bank_type=0;
$result=$transaccount->save();
  }
  
}
if($result){
     return response()->json(['success'=>'Book saved successfully.']);
    }

}       
        // $psid=book::select('*')->where([['name','=',$party]])->first();
        // //$prid=$sid['id'];
        // $psrid=$psid['id'];
        // //$batch=$req->batch;
        // //$expiry=$req->expiry;
        // $discount=$req->disc11;
        // $booker=$req->booker;
        // $town=$req->town;
        //$pros=product::select('*')->where([['name','=',$req->search]])->first();
        // //$prxxx=$pros['id'];
        // $stk=stock::select('*')->where([['name',$req->search]])->where('pharma_id','=',$pid)->first();
        // $stkall=stock::where([['name',$req->search]])->where('pharma_id','=',$pid)->sum('units');
// $date=date("Y-m-d");

 //   }
     public function deleteinvoice(Request $req){
    $uid=session('user_id');
        $pid=session('pharma_id');
        date_default_timezone_set("Asia/Karachi");
        $date=$req->date;
        $time=date("h:i:sa");
        $inv=$req->pinv;
$stx=sale::select('*')->where('pharma_id','=',$pid)->where([['inv',$inv]])->get();
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
sale::where('inv',$inv)->delete();
salesbook::where('id',$inv)->delete();
$result=transaccount::where([['type','Sales'],['inv',$inv]])->delete();
if($result){
         return response()->json(['success'=>'Sale Deleted successfully.']);
        }



      
 }
    
}
