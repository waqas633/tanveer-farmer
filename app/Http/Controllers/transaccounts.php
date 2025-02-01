<?php

namespace App\Http\Controllers;

use App\Models\accountType;
use App\Models\localsale;
use App\Models\wholesale;
use Illuminate\Http\Request;

use App\Models\transaccount;
use App\Models\sale;
use App\Models\recovery;
use App\Models\bankRecovery;
use App\Models\cashRecovery;
use App\Models\book;
use App\Models\letterhead;
use App\Models\stock;
use App\Models\expense;
use Carbon\Carbon;
use DB;
class transaccounts extends Controller
{
    public function cashbanktransection(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
        $from = $req->date1;
$to = $req->date2;
//for opening
$openStart = BankRecovery::where('date', '>=', '2016-03-30')
    ->where('date', '<', $from)
    ->get();
    $opencr=$openStart->SUM('cr');
     $opendr=$openStart->SUM('dr');




//endforopening
//$oldpre=transaccount::select([transaccount::raw("SUM(dr) as total_debit"), transaccount::raw("SUM(cr) as total_credit")])->whereIn('type',['BankTransection', 'CashTransection'])->whereBetween('date', ['2016-03-30', $from])->where('name', '!=', '4')->where('pharma_id','=',$pid)->get();
$oldpre=transaccount::select([transaccount::raw("SUM(dr) as total_debit"), transaccount::raw("SUM(cr) as total_credit")])->whereIn('type',['Banks', 'CashRecovery','Expenses','OpeningBalance'])
->where('date', '>=', '2016-03-30')
    ->where('date', '<', $from)->where('pharma_id','=',$pid)->get();



$currentr=transaccount::select([transaccount::raw("SUM(dr) as total_debit"), transaccount::raw("SUM(cr) as total_credit")])->whereIn('type',['Banks', 'CashRecovery','Expenses','OpeningBalance'])->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->get();
// $dated2=transaccount::select([transaccount::raw("SUM(dr) as total_debit"), transaccount::raw("SUM(cr) as total_credit")])->whereIn('type',['BankTransection', 'CashTransection'])->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->get();
// Debugging: Print out the values for verification

// $totalCredit = $currentr->first()->total_credit;
// $totalDebit = $currentr->first()->total_debit;
// dd($totalCredit,$totalDebit ); // This will dump the values to check
$pros3=transaccount::with('book','bankRequires')->whereBetween('date', [$from, $to])->whereIn('type',['Banks', 'CashRecovery','Expenses'])->where('pharma_id','=',$pid)->get();
   $banks=bankRecovery::with('pbook','rbook')->whereBetween('date', [$from, $to])->get();
//   $cash=cashRecovery::with('pbook')->whereBetween('date', [$from, $to])->get();
    return response()->json([
        'oldpre'=>$oldpre,
        'pros3'=>$pros3,
        'banks'=>$banks,
        // 'cash'=>$cash,
        'currentr'=>$currentr,
        'opencr'=>$opencr,
'opendr'=>$opendr,

    ]);
  }
    public function balanceSheet(Request $req){
        $uid=session('user_id');
    $pid=session('pharma_id');
        $stx=DB::table('transaccounts')->select('type', DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))
        ->where('name','!=','1')
  ->where('name','!=','2')
  ->where('pharma_id','=',$pid)
        ->groupBy('type')->get();
        $cashes=DB::table('transaccounts')->select('bank_type', DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"),DB::raw("SUM(cr)-SUM(dr) as balance"))
        ->whereIn('bank_type',[1, 2])
->groupBy('bank_type')
  ->where('pharma_id','=',$pid)->get();
        $stx1=DB::table('transaccounts')->select('type', DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"))
        ->where('name','!=','1')
  ->where('name','!=','2')
  ->where('pharma_id','=',$pid)
        ->get();
        $dues=transaccount::select(transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->where('pharma_id','=',$pid)
     ->where('name','!=','1')
  ->where('name','!=','2')
  ->where('name','!=','34')
    ->get();
    $expenses=expense::with('expenseHead')->select('expenseHead_id',expense::raw('SUM(amount) as amount'))
    ->where('pharma_id','=',$pid)
    ->groupBy('expenseHead_id')
    ->get();
        $price=stock::where('pharma_id','=',$pid)->sum('price');
        return view('balancesheet',[
        'var'=>$stx,
        'var1'=>$stx1,
        'price'=>$price,
        'cashes'=>$cashes,
        'dues'=>$dues,
        'expenses'=>$expenses,
    ]);
    }

  public function datesale(Request $req){
      $cname=$req->cname;
     $sidx="0";
      $ppidc=book::where('name',$cname)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
    $uid=session('user_id');
    $pid=session('pharma_id');
        $from = $req->date1;
$to = $req->date2;


$dated2=transaccount::select([transaccount::raw("SUM(dr) as total_debit"), transaccount::raw("SUM(cr) as total_credit")])->where('name', '=', $sidx)->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->get();

$pros3=transaccount::where('name', '=', $sidx)->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->groupBy('type');
$pros2=transaccount::select('type',transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->where('name',$sidx)
    ->where('pharma_id','=',$pid)
    ->whereBetween('date', [$from, $to])
    ->groupBy('type')
    ->get();
    return response()->json([
        'dated2'=>$dated2,
        'pros2'=>$pros2,

    ]);
  }
  public function datesale1(Request $req){
      $cname=$req->cname;
     $sidx="0";
      $ppidc=book::where('name',$cname)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
    $uid=session('user_id');
    $pid=session('pharma_id');
        $from = $req->date1;
$to = $req->date2;


$dated2=transaccount::where('name', '=', $sidx)->whereBetween('date', [$from, $to])->orderBy('date', 'ASC')->where('pharma_id','=',$pid)->get();
$salesx=sale::where('party', '=', $sidx)->get();
$pros3=transaccount::where('name', '=', $sidx)->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->groupBy('type');
$pros2=transaccount::select(transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->where('name',$sidx)
    ->where('pharma_id','=',$pid)
    ->whereBetween('date', [$from, $to])
    ->groupBy('name')
    ->get();
  
    return response()->json([
        'dated2'=>$dated2,
        'pros2'=>$pros2,
        'sales'=>$salesx,
        

    ]);
  }
  public function datesale2(Request $req){
      $cname=$req->cname;
     $sidx="0";
      $ppidc=book::where('name',$cname)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
    $uid=session('user_id');
    $pid=session('pharma_id');
        $strt = '2023-01-01';
        $from = $req->date1;
$to = $req->date2;
$wholesalesx=wholesale::where('fid', '=', $sidx)->orWhere('fid', '=', $sidx)->get();
$localsalesx=localsale::where('purchaser', '=', $sidx)->get();
// $recovery=recovery::where('name', '=', $sidx)->get();
$bankRec=bankRecovery::with('bank')->where('rid', '=', $sidx)->orWhere('pid', '=', $sidx)->get();
$dated2=transaccount::where('name', '=', $sidx)->whereBetween('date', [$from, $to])->orderBy('date', 'ASC')->orderBy('id', 'ASC')->where('pharma_id','=',$pid)->get();
$open=transaccount::select(transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->where('name',$sidx)
    ->where('pharma_id','=',$pid)
    ->whereBetween('date', [$strt, $from])
    ->get();
$pros3=transaccount::where('name', '=', $sidx)->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->groupBy('type');
$pros2=transaccount::select(transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->where('name',$sidx)
    ->where('pharma_id','=',$pid)
    ->whereBetween('date', [$from, $to])
    ->groupBy('name')
    ->get();
    $ltrhd=letterhead::all()->where('id','=',$pid)->last();
    $party1=book::where('id', '=', $sidx)->where('pharma_id','=',$pid)->first();
  return view('ledgerbillprint',['dated2'=>$dated2,'pros2'=>$pros2,'party1'=>$party1,'ltrhd'=>$ltrhd,'wholesales'=>$wholesalesx,'localsales'=>$localsalesx,'open'=>$open,'bankRec'=>$bankRec]);
 //return to_route('ledgerbillprint', ['dated2'=>$dated2,'pros2'=>$pros2,'party1'=>$party1,'ltrhd'=>$ltrhd]);
  }
  public function publicLedgers(Request $req){
     $sidx="0";
      $ppidc=book::get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
    $uid=session('user_id');
    $pid=session('pharma_id');
    $customers = book::whereIn('type', ['Purchaser','Retailer'])->pluck('id')->toArray();
    $closing=transaccount::select('name',transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->with('book')
    ->where('pharma_id','=',$pid)
  ->whereIn('name',$customers)
    ->groupBy('name')
    ->get();
    $closingvalues=transaccount::select(transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
    ->where('pharma_id','=',$pid)
    ->whereIn('name',$customers)
    ->get();
    return view('customerledgerdetailsfinal',['dated2'=>$closing,'dated1'=>$closingvalues]);
      
  }
  public function publicLedgerDetails(Request $req){
   $uid=session('user_id');
   $pid=session('pharma_id');
   $acctype=accountType::all();
   $closing=transaccount::select('name',transaccount::raw('SUM(cr) as cr'),transaccount::raw('SUM(dr) as dr'))
   ->with('book')
   ->where('pharma_id','=',$pid)
   ->groupBy('name')
   ->get();
   return view('customerledgerdetailsfinalcategory',['dated'=>$closing,'acctype'=>$acctype]);
     
 }
  public function profitView(Request $req){
        $uid=session('user_id');
    $pid=session('pharma_id');
    $value=$req->date;
    $incentive=transaccount::where('pharma_id','=',$pid)->where('date', 'like', '%'.$value.'%')->where('name','=','38')->sum('cr');
   $pros2=expense::where('date', 'like', '%'.$value.'%')->where('pharma_id','=',$pid)->sum('amount');
    $profit=sale::where('created_at', 'like', '%'.$value.'%')->where('pharma_id','=',$pid)->sum('profit');
    //echo $incentive;
    $tox=$profit-$pros2+$incentive;
       return response()->json([
        'profit'=>$profit,
        'pros2'=>$pros2,
        'tox'=>$tox,
        'incentive'=>$incentive,
    ]);
    
  }
  public function cashView(Request $req){
        $uid=session('user_id');
    $pid=session('pharma_id');
    //$value=$req->date;
    //$value1=$req->date1;
    $value = Carbon::createFromFormat('Y-m-d', $req->date);
$value1 = Carbon::createFromFormat('Y-m-d', $req->date1);
    $open=DB::table('transaccounts')->select('bank_type', DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"),DB::raw("SUM(cr)-SUM(dr) as balance"))
        ->where('bank_type','1')->whereBetween('date', ['2023-01-01',$value])->where('pharma_id','=',$pid)->get();
  $cls=DB::table('transaccounts')->select('bank_type', DB::raw("SUM(cr) as cr"), DB::raw("SUM(dr) as dr"),DB::raw("SUM(cr)-SUM(dr) as balance"))
        ->where('bank_type','1')->whereBetween('date', ['2023-01-01',$value1])->where('pharma_id','=',$pid)->get();
    $incentive=transaccount::where('pharma_id','=',$pid)->whereBetween('date', [$value,$value1])->where('type','=','Recovery')->sum('cr');
    $payment=transaccount::where('pharma_id','=',$pid)->whereBetween('date', [$value,$value1])->where('type','=','payment')->sum('dr');
   $pros2=expense::whereBetween('date', [$value,$value1])->where('pharma_id','=',$pid)->sum('amount');
    //echo $incentive;
       return response()->json([
        'pros2'=>$pros2,
        'incentive'=>$incentive,
        'open'=>$open,
        'cls'=>$cls,
        'payment'=>$payment,
    ]);
    
  }
}
