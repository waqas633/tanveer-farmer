<?php

namespace App\Http\Controllers;
use App\Models\purchase;
use App\Models\purchasebook;
use App\Models\book;
use App\Models\item;
use App\Models\product;
use App\Models\stock;
use App\Models\transaccount;
use Illuminate\Http\Request;
use DataTables;
class purchases extends Controller
{
   public function datesaleview(Request $req){
         $uid=session('user_id');
        $pid=session('pharma_id');
        $cname=$req->pid;
        $dated2=purchase::where('name', '=', $cname)->where('pharma_id','=',$pid)->get();
$dated2->load('item','item.brand','item.brand.group','books');
        return view('productvisepurchaseview',['var'=>$dated2]);
        
  }
    public function datesale(Request $req){
           $uid=session('user_id');
        $pid=session('pharma_id');
        $from = $req->date1;
$to = $req->date2;
$proname=$req->proname;
$proname=$req->proname;
$cname=$req->cname;
if($cname==null){
    $psrid='0';
}else{
 $psid=book::select('*')->where([['name','=',$cname]])->first();
        //$prid=$sid['id'];
        $psrid=$psid['id'];   
}

//$sid=book::select('*')->where([['name','=',$proname]])->first();
       // $prid=$sid['id'];
        //with('item','item.brand','item.brand.group');
$dated2=purchase::with('item','item.brand','item.brand.group')->where('party', '=', $psrid)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$pros2=purchase::with('item','item.brand','item.brand.group')->where('party', '=', $psrid)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('purchase');
$dated1=purchase::with('item','item.brand','item.brand.group')->where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$pros1=purchase::with('item','item.brand','item.brand.group')->where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('purchase');
$dated=purchase::with('item','item.brand','item.brand.group')->whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->get();
    $pros=purchase::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('purchase');
    return response()->json([
        'dated'=>$dated,
        'dated1'=>$dated1,
        'dated2'=>$dated2,
        'pros'=>round($pros,2),
        'pros1'=>round($pros1,2),
        'pros2'=>round($pros2,2),

    ]);
  }
  public function dateinvoicedetails(Request $req){
           $uid=session('user_id');
        $pid=session('pharma_id');
      //  $from = $req->date1;
//$to = $req->date2;
$proname=$req->proname;
//$cname=$req->cname;
//$sid=product::select('*')->where([['name','=',$proname]])->first();
       // $prid=$sid['id'];
        //with('item','item.brand','item.brand.group');
$dated2=purchase::with('item','item.brand','item.brand.group','purchasebook')->where('inv', '=', $proname)->where('pharma_id','=',$pid)->get();
$pros2=purchase::with('item','item.brand','item.brand.group','purchasebook')->where('inv', '=', $proname)->where('pharma_id','=',$pid)->sum('purchase');
    return view ('datevisepurchases',[
        'dated2'=>$dated2,
        'pros2'=>round($pros2,2),

    ]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           $uid=session('user_id');
        $pid=session('pharma_id');
        $purchases = purchase::latest()->get();
        
        if ($request->ajax()) {
            $data = purchase::latest()->where('pharma_id','=',$pid)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('purchases',compact('purchases'));
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo $request->title;
      purchase::updateOrCreate(['id' => $request->book_id],
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
       $book = purchase::find($id)->where('pharma_id','=',$pid);
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
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = product::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 
    public function autopurchasecustomer(Request $request)
    {
           $uid=session('user_id');
        $pid=session('pharma_id');
          $query = $request->get('query');
          $filterResult = book::where('name', 'LIKE', '%'. $query. '%')->where('pharma_id','=',$pid)->get();
          return response()->json($filterResult);
    } 
    public function fetchrate(Request $req){
        $pros=$req->search;
   $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=product::select('*')->where([['name','=',$pros]])->first();
        $price=$sid['price'];
        $formula=$sid['formula'];
        $pack=$sid['pack'];
        $distribution=$sid['distribution'];
        $company=$sid['company'];
        $type=$sid['type'];
        $cogroup=$sid['cogroup'];
        $purchase=$sid['purchase'];
        $pid=$sid['id'];
        $pname=$sid['name'];
    return response()->json([
        'price'=>$price,
        'purchase'=>$purchase,
        'formula'=>$formula,
        'pack'=>$pack,
         'distribution'=>$distribution,
        'company'=>$company,
        'type'=>$type,
        'cogroup'=>$cogroup,
         'pid'=>$pid,
        'pname'=>$pname,
        
    ]);
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
       $id=$req->a;
       purchase::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
    public function calcu(Request $req){
           $uid=session('user_id');
        $pid=session('pharma_id');
        $name=$req->search;
        $units=$req->units;
        $inv=$req->inv;
        $party=$req->party;
        $unitprice=$req->unitprice;
        $unitsale=$req->unitsale;
        $batch=$req->unitprice;
        $expiry=$req->unitsale;
        $date=date("Y-m-d");
        $totalunitsprice=round($units*$unitprice,2);
        $totalunitspprice=round($units*$unitsale,2);
      // $sid=product::select('*')->where([['name','=',$name]])->first();
       // $prid=$sid['id'];
        $psid=book::select('*')->where([['name','=',$party]])->first();
        //$prid=$sid['id'];
        $psrid=$psid['id'];
        $product=new purchase;
$product->name=$name;
$product->units=$units;
$product->price=$unitprice;
$product->purchase=$totalunitsprice;
$product->discount="";
$product->party=$psrid;
$product->inv=$inv;
$product->created_at=$date;
$product->batch=$batch;
$product->expiry=$expiry;
$product->users=$uid;
$product->pharma_id=$pid;
$product->saleprice=$totalunitspprice;



$result=$product->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
  


    }
 public function fetchpurchaselist(Request $req){
       $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=purchasebook::all()->last();
        $ssid=$sid['id']+1;
    $stx=purchase::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $stx->load('item','item.brand','item.brand.group');
    $stx->load('books');
    $pros=purchase::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('purchase');
    return response()->json([
        'stx'=>$stx,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
    ]);
  }
 public function finalBill(Request $req){
      $sidx="0";
       $uid=session('user_id');
        $pid=session('pharma_id');
      $inv=$req->inv;
      $bid=$req->bid;
        $party=$req->party;
        $ppidc=book::where('name',$party)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
        $tot=$req->tot;
        $disco=$req->disco;
        $cas=$req->cas;
        $netcas=$req->netcas;
        $bdate=$req->bdate;
        $cdate=$req->cdate;
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $time=date("h:i:sa");

    $stx=purchase::select('*')->where('pharma_id','=',$pid)->where('inv', '=', $inv)->get();
    foreach($stx as $sty) {
        $pname=$sty['name'];
        $punitse=$sty['units'];
        //echo $pname;
        $pbatch=$sty['batch'];
        $pprice=$sty['purchase'];
        $pexpiry=$sty['expiry'];
        $stj=stock::select('*')->where('pharma_id','=',$pid)->where('name', '=', $pname)->first();
        $prods=item::select('*')->where('id', '=', $pname)->first();
        $produnit=$prods['units'];
        $produnits=$produnit*$punitse;
//$jname=$stj['name'];
     //   $jbatch=$stj['batch'];
     //   $jexpiry=$stj['expiry'];
        $result=stock::select('*')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->first();
      if($result){
          $newunits=$result['units']+$produnit;
          $newPrice=$result['price']+$pprice;
        stock::where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->update(['units'=>$newunits,'price'=>$newPrice]);
      }else{
         $stock=new stock;
$stock->name=$sty['name'];
$stock->units=$produnits;
$stock->price=$sty['purchase'];
$stock->ppt=$sty['price'];
$stock->batch=$sty['batch'];
$stock->expiry=$sty['expiry'];
$stock->pharma_id=$pid;
$stock->user=$uid;
$stock->save();

      }     
}




        $salesbook=new purchasebook;
$salesbook->name=$sidx;
$salesbook->sale=$tot;
$salesbook->purchase=$cas;
$salesbook->discount=$disco;
$salesbook->balnce=$netcas;
$salesbook->date=$bdate;
$salesbook->time=$time;
$salesbook->pharma_id=$pid;
$salesbook->user=$uid;
$salesbook->inv=$bid;
$salesbook->cdate=$cdate;
$salesbook->save();
$transaccount=new transaccount;
$transaccount->name=$sidx;
$transaccount->type="Purchases";
$transaccount->cr=$tot;
$transaccount->dr=$cas;
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$pid;
$transaccount->user=$uid;
$result=$transaccount->save();
//$salesbook->save();
if($result){
         return response()->json(['success'=>'Purchases saved successfully.']);
        }
      
 }
    
}
