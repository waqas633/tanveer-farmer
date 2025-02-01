<?php

namespace App\Http\Controllers;
use App\Models\book;
use App\Models\payment;
use App\Models\transaccount;
use App\Models\expenseHead;
use App\Models\expense;
use Illuminate\Http\Request;

class payments extends Controller
{
     public function dailyexpenses(Request $req){
         $from = $req->date1;
$to = $req->date2;
$pid=session('pharma_id');
$dated2=payment::with('book')->where('type','=','2')->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->get();
$pros2=payment::where('type','=','2')->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->sum('amount');
       return response()->json([
        'dated'=>$dated2,
        'pros'=>$pros2,
        ]);
         
     }
    public function datesale(Request $req){
        $from = $req->date1;
$to = $req->date2;
$sidx="0";
$proname=$req->proname;
$proname=$req->proname;
$cname=$req->cname;
$ppidc=book::where('name',$cname)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
$uid=session('user_id');
        $pid=session('pharma_id');
$dated2=payment::where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->get();
$pros2=payment::where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->sum('amount');
$dated1=payment::where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->get();
$pros1=payment::where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->sum('amount');
$dated=payment::whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->get();
    $pros=payment::whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->sum('amount');
    return response()->json([
        'dated'=>$dated,
        'dated1'=>$dated1,
        'dated2'=>$dated2,
        'pros'=>round($pros,2),
        'pros1'=>round($pros1,2),
        'pros2'=>round($pros2,2),

    ]);
  }
 public function index(Request $req){
     $tid=0;
    $uid=session('user_id');
        $pid=session('pharma_id');
   $sid=payment::all()->last();
        $ssid=$sid['id']+1;
        $items = (string)$ssid;
        
    return view("payments");
 }
  public function fetchpayments(Request $req){
      $tid=0;
    $uid=session('user_id');
        $pid=session('pharma_id');
    $sid=payment::all()->last();
        $ssid=$sid['id']+1;
        $dates=$req->pname;
        $date=date("Y-m-d");
    $stx=payment::with('book')->where('type','=','1')->where('pharma_id','=',$pid)->get();
    $pros=payment::where('type','=','1')->where('pharma_id','=',$pid)->sum('amount');
    return response()->json([
        'stx'=>$stx,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
    ]);
}
public function fetchexpenses(Request $req){
      $tid=0;
    $uid=session('user_id');
        $pid=session('pharma_id');
    $sid=expense::all()->last();
    $heads=expenseHead::all();
    $banks = Book::whereIn('type', ['Banks', 'Net Cash'])->get();
        $ssid=$sid['id'] ?? 0+1;
        $dates=$req->pname;
        $date=date("Y-m");
//    $stx=payment::with('book')->where('date','like', '%'.$date.'%')->where('pharma_id','=',$pid)->where('type','=','2')->get();
      $stx=expense::with('expenseHead')->orderBy('date', 'DESC')->where('pharma_id','=',$pid)->get();

   // $pros=payment::where('date','like', '%'.$date.'%')->where('type','=','2')->where('pharma_id','=',$pid)->sum('amount');
   $pros=expense::where('pharma_id','=',$pid)->sum('amount');
    return response()->json([
        'stx'=>$stx,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
        'heads'=>$heads,
        'banks'=>$banks,
    ]);
}
  
  public function autopaymentcustomer(Request $request)
    {
        $uid=session('user_id');
        $pid=session('pharma_id');
          $query = $request->get('query');
          $filterResult = book::where('name', 'LIKE', '%'. $query. '%')->where('pharma_id','=',$pid)->get();
          return response()->json($filterResult);
    }
    public function calcu(Request $req){
        $sidx="0";
        $uid=session('user_id');
        $pharmaid=session('pharma_id');
        $pname=$req->pname;
        $pid=$req->pid;
        $details=$req->pdetails;
        $pamount=$req->pamount;
        $gdate=$req->ddate;
       $contra=$req->contra;
       $ppidc=book::where('name',$pname)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
        $product=new payment;
        $product->id=$pid;
        $product->date=$gdate;
$product->name=$sidx;
$product->details=$details;
$product->amount=$pamount;
$product->user=$uid;
$product->pharma_id=$pharmaid;
$product->save();
$transaccount=new transaccount;
$transaccount->name=$sidx;
$transaccount->type="Payment";
$transaccount->cr="0";
$transaccount->dr=$pamount;
$transaccount->date=$gdate;
$transaccount->inv=$pid;
$transaccount->user=$uid;
$transaccount->pharma_id=$pharmaid;
$transaccount->bank_type=$contra;
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
  


    }
    public function calcuexp(Request $req){
        $sidx="0";
        $uid=session('user_id');
        $pharmaid=session('pharma_id');
        $pname=$req->pname;
        $pid=$req->pid;
        $details=$req->pdetails;
        $pamount=$req->pamount;
        $gdate=$req->ddate;
        $head=$req->head;
        $contra=$req->contra;
      // $ppidc=book::where('name',$pname)->get();
      // foreach ($ppidc as $c){
        //   $sidx=$c['id'];
      // }
//INSERT INTO `expenses` (`id`, `expenseHead_id`, `details`, `amount`, `date`, `user`, `pharma_id`)
        $product=new expense;
        $product->id=$pid;
        $product->date=$gdate;
$product->expenseHead_id=$head;
$product->name=$contra;
$product->details=$details;
$product->amount=$pamount;
$product->user=$uid;
$product->pharma_id=$pharmaid;
$product->save();
$transaccount=new transaccount;
$transaccount->name=$head;
$transaccount->type="Expenses";
$transaccount->cr="0";
$transaccount->dr=$pamount;
$transaccount->date=$gdate;
$transaccount->inv=$pid;
$transaccount->user=$uid;
$transaccount->pharma_id=$pharmaid;
$transaccount->bank_type=$contra;
$transaccount->save();
$transaccount=new transaccount;
$transaccount->name=$contra;
$transaccount->type="Expenses";
$transaccount->dr="0";
$transaccount->cr=$pamount;
$transaccount->date=$gdate;
$transaccount->inv=$pid;
$transaccount->user=$uid;
$transaccount->pharma_id=$pharmaid;
$transaccount->bank_type=$contra;
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
  


    }
     public function destroy($id)
    {
        transaccount::select('*')->where([['inv','=',$id],['type','=','payment']])->delete();
       payment::find($id)->delete();

     
        //return response()->json(['success'=>'Book deleted successfully.']);
        return view("payments");
    }
     public function destroyExpenses($id)
    {
        transaccount::select('*')->where([['inv','=',$id],['type','=','Expenses']])->delete();
       expense::find($id)->delete();

     
        //return response()->json(['success'=>'Book deleted successfully.']);
        return view("expenses");
    }
}
