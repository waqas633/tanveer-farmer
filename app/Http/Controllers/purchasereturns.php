<?php

namespace App\Http\Controllers;
use App\Models\purchasereturn;
use App\Models\purchasereturnbook;
use App\Models\book;
use App\Models\product;
use App\Models\stock;
use App\Models\transaccount;
use Illuminate\Http\Request;

class purchasereturns extends Controller
{
      
    public function datesale(Request $req){
        $pid=session('pharma_id');
        $from = $req->date1;
$to = $req->date2;
$proname=$req->proname;
$proname=$req->proname;
$cname=$req->cname;

$dated2=purchasereturn::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$pros2=purchasereturn::where('party', '=', $cname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('purchase');
$dated1=purchasereturn::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->get();
$pros1=purchasereturn::where('name', '=', $proname)->where('pharma_id','=',$pid)->whereBetween('created_at', [$from, $to])->sum('purchase');
$dated=purchasereturn::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->get();
    $pros=purchasereturn::whereBetween('created_at', [$from, $to])->where('pharma_id','=',$pid)->sum('purchase');
    return response()->json([
        'dated'=>$dated,
        'dated1'=>$dated1,
        'dated2'=>$dated2,
        'pros'=>round($pros,2),
        'pros1'=>round($pros1,2),
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
        $pid=session('pharma_id');
        $purchases = purchasereturn::latest()->where('pharma_id','=',$pid)->get();
        
        if ($request->ajax()) {
            $data = purchasereturn::latest()->where('pharma_id','=',$pid)->get();
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
      
        return view('purchasereturns',compact('purchases'));
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
      purchasereturn::updateOrCreate(['id' => $request->book_id],
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
        $pid=session('pharma_id');
       $book = purchasereturn::find($id)->where('pharma_id','=',$pid);
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
    public function destroy(Request $req)
    {
       $id=$req->a;
       purchasereturn::find($id)->delete();
     
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
        $batch=$req->batch;
        $expiry=$req->expiry;
        $date=date("Y-m-d");
        $totalunitsprice=round($units*$unitprice,2);
        $totalunitspprice=round($units*$unitsale,2);
       
        $product=new purchasereturn;
$product->name=$name;
$product->units=$units;
$product->price=$unitprice;
$product->purchase=$totalunitsprice;
$product->discount="";
$product->party=$party;
$product->inv=$inv;
$product->created_at=$date;
$product->batch=$batch;
$product->expiry=$expiry;
$product->user=$uid;
$product->pharma_id=$pid;
$product->saleprice=$totalunitspprice;



$result=$product->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
  


    }
 public function fetchpurchaselist(Request $req){
    $pid=session('pharma_id');
        $sid=purchasereturnbook::all()->where('pharma_id','=',$pid)->last();
        $ssid=$sid['id']+1;
    $stx=purchasereturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->get();
    $pros=purchasereturn::where('inv', '=', $ssid)->where('pharma_id','=',$pid)->sum('purchase');
    return response()->json([
        'stx'=>$stx,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
    ]);
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

    $stx=purchasereturn::select('*')->where('inv', '=', $inv)->where('pharma_id','=',$pid)->get();
    foreach($stx as $sty) {
        $pname=$sty['name'];
        $punitse=$sty['units'];
        echo $pname;
        $pbatch=$sty['batch'];
        $pexpiry=$sty['expiry'];
        $stj=stock::select('*')->where('name', '=', $pname)->where('pharma_id','=',$pid)->first();
        $prods=product::select('*')->where('name', '=', $pname)->first();
        $produnit=$prods['pack'];
        $produnits=$produnit*$punitse;
$jname=$stj['name'];
        $jbatch=$stj['batch'];
        $jexpiry=$stj['expiry'];
        $result=stock::select('*')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->first();
      if($result){
        stock::select('stocks')->where('pharma_id','=',$pid)->where([['name', $pname],['batch',$pbatch],['expiry',$pexpiry]])->decrement('units',$produnits);
      }else{
         $stock=new stock;
$stock->name=$sty['name'];
$stock->units=$produnits;
$stock->price=$sty['purchase'];
$stock->ppt=$sty['price'];
$stock->batch=$sty['batch'];
$stock->expiry=$sty['expiry'];
$stock->user=$uid;
$stock->pharma_id=$pid;
$stock->save();

      }     
}




        $salesbook=new purchasereturnbook;
$salesbook->name=$party;
$salesbook->sale=$tot;
$salesbook->purchase=$cas;
$salesbook->discount=$disco;
$salesbook->balnce=$netcas;
$salesbook->date=$date;
$salesbook->time=$time;
$salesbook->user=$uid;
$salesbook->pharma_id=$pid;
$salesbook->save();
$transaccount=new transaccount;
$transaccount->name=$party;
$transaccount->type="Purchases Return";
$transaccount->cr=$cas;
$transaccount->dr=$tot;
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->user=$uid;
$transaccount->pharma_id=$pid;
$transaccount->save();
$result=$salesbook->save();
if($result){
         return response()->json(['success'=>'Purchases Return saved successfully.']);
        }
      
 }
}
