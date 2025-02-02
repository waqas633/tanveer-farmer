<?php

namespace App\Http\Controllers;
use App\Models\accountType;
use App\Models\bank;
use App\Models\bankRecovery;
use App\Models\book;
use App\Models\cashRecovery;
use App\Models\recovery;
use App\Models\transaccount;
use App\Models\salesbook;
use App\Models\purchasebook;
use Illuminate\Http\Request;
use DB;

class recoverys extends Controller
{
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
$dated2=recovery::with('book')->where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->get();
$pros2=recovery::where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->sum('amount');
$dated1=recovery::with('book')->where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->get();
$pros1=recovery::where('name', '=', $sidx)->where('pharma_id','=',$pid)->whereBetween('date', [$from, $to])->sum('amount');
$dated=recovery::with('book')->whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->get();
    $pros=recovery::whereBetween('date', [$from, $to])->where('pharma_id','=',$pid)->sum('amount');
    return response()->json([
        'dated'=>$dated,
        'dated1'=>$dated1,
        'dated2'=>$dated2,
        'pros'=>round($pros,2),
        'pros1'=>round($pros1,2),
        'pros2'=>round($pros2,2),

    ]);
  }
  public function fetchrecoverydatewise(Request $req){
      $date=$req->date;
       $pid=session('pharma_id');
 $stx=bankRecovery::with('pbook')->with('rbook')->with('bank')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
   return response()->json([
        'stx'=>$stx,
    ]);
      
  }
   public function fetchcashrecoverydatewise(Request $req){
      $date=$req->date;
       $pid=session('pharma_id');
 $stx1=cashRecovery::with('pbook')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
  $stx=bankRecovery::with('pbook')->with('rbook')->with('bank')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
   return response()->json([
        'stx'=>$stx,
         'stx1'=>$stx1,
    ]);
      
  }
 
  public function index(Request $req){
    $bk12=book::all();
    $bk13=transaccount::select('name',DB::raw('SUM(cr) - SUM(dr) as balance'))->with('book')
    ->groupBy('name')
    ->get();
    $pid=session('pharma_id');
    // dd($book12);
    $acctype=accountType::all();
    $banks=bank::all();
    $sid1=bankRecovery::all()->last();
        $ssid1=$sid1['id'] ?? 0+1;
        $items = (string)$ssid1;
        $date=date("Y-m-d");
        $stx=bankRecovery::with('pbook')->with('rbook')->with('bank')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
        
   // return view("recovery",['bk12'=>$bk12,'acctype'=>$acctype,'banks'=>$banks,'stx'=>$stx]);
    $sid=cashRecovery::pluck('id')->last();
        $ssid=$sid + 1;
        $items = (string)$ssid;
        $date=date("Y-m-d");
        $stxcash=cashRecovery::with('pbook')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
        $sumall=$stx->sum('amount');
       return view("recoveriess",['bk12'=>$bk12,'bk13'=>$bk13,'acctype'=>$acctype,'banks'=>$banks,'stx'=>$stx,'stxcash'=>$stxcash,'ssid'=>$ssid,'ssid1'=>$ssid1,'sumall'=>$sumall]);
 }
 public function index1(Request $req){
    $bk12=transaccount::select('name',DB::raw('SUM(cr) - SUM(dr) as balance'))->with('book')
    ->groupBy('name')
    ->get();
    $pid=session('pharma_id');
    // dd($book12);
    $acctype=accountType::all();
    $banks=bank::all();
    $sid=cashRecovery::pluck('id')->last();
        $ssid=$sid + 1;
        $items = (string)$ssid;
        $date=date("Y-m-d");
        $stx=cashRecovery::with('pbook')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
        $sumall=$stx->sum('amount');
    return view("cashrecovery",['bk12'=>$bk12,'acctype'=>$acctype,'banks'=>$banks,'stx'=>$stx,'ssid'=>$ssid,'sumall'=>$sumall]);
 }
 public function bankRecoveryUpdate(Request $req){
    $inv=$req->inv;
    $pid=$req->pid;
    $rid=$req->rid;
    $amount=$req->pamount;
    $discription=$req->pdetails;
    $date=$req->ddate;
    $bank_id=$req->bank_id;
    $uid=session('user_id');
    $phid=session('pharma_id');
    //salesbook::where('id',$bid)->update(['purchase'=>$pamount]);
    // `id`, `date`, `recevier`, `pay`, `bank_id`, `amount`, `discription`, `uid
       // $product=new bankRecovery;
       $invc_ids=Transaccount::where('type', 'BankTransection')
                            ->where('inv', $inv)->pluck('id')->toArray();
                            // return $invc_ids[0]; 
       $product=bankRecovery::find($inv);
        //$product->id=$inv;
        // $product->date=$date;
        $product->rid=$rid;
        $product->pid=$pid;
        $product->bank_id=$bank_id;
        $product->cr=$amount;
        $product->dr=$amount;
        $product->discription=$discription;
        $product->uid=$uid;
        $product->pharma_id=$phid;
$product->save();
// $transaccount=new transaccount;
// Transaccount::where('type', 'Banks')
//                             ->where('inv', $inv)->pluck('id')->toArray();
$transaccount = Transaccount::where('type', 'BankTransection')
                            ->where('id', $invc_ids[0])->first();
$transaccount->name=$rid;
$transaccount->type="BankTransection";
$transaccount->cr=$amount;
$transaccount->dr="0";
// $transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$phid;
$transaccount->user=$uid;
$transaccount->bank_type=$bank_id;
$transaccount->save();
$transaccount1 = Transaccount::where('type', 'BankTransection')->where('id', $invc_ids[1])->first();
                            // ->where('inv', $inv)
                            // ->offset(1)
                            // ->limit(1)
                            // ->first();
$transaccount1->name=$pid;
$transaccount1->type="BankTransection";
$transaccount1->dr=$amount;
$transaccount1->cr="0";
// $transaccount1->date=$date;
$transaccount1->inv=$inv;
$transaccount1->pharma_id=$phid;
$transaccount1->user=$uid;
$transaccount1->bank_type=$bank_id;
$result=$transaccount1->save();
if($result){
         return response()->json(['success'=>'Book updated successfully.']);
        }

 }
 public function bankRecovery(Request $req){
    $inv=$req->inv;
    $pid=$req->pid;
    $rid=$req->rid;
    $amount=$req->pamount;
    $discription=$req->pdetails;
    $date=$req->ddate;
    $bank_id=$req->bank_id;
    $uid=session('user_id');
    $phid=session('pharma_id');
    //salesbook::where('id',$bid)->update(['purchase'=>$pamount]);
    // `id`, `date`, `recevier`, `pay`, `bank_id`, `amount`, `discription`, `uid
        $product=new bankRecovery;
        $product->id=$inv;
        $product->date=$date;
        $product->rid=$rid;
        $product->pid=$pid;
        $product->type="Banks";
        $product->bank_id=$bank_id;
        $product->cr=$amount;
         $product->dr=$amount;
        $product->discription=$discription;
        $product->uid=$uid;
        $product->pharma_id=$phid;
$product->save();
$transaccount=new transaccount;
$transaccount->name=$rid;
$transaccount->type="Banks";
$transaccount->cr=$amount;
$transaccount->dr="0";
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$phid;
$transaccount->user=$uid;
$transaccount->bank_type=$bank_id;
$transaccount->save();
$transaccount=new transaccount;
$transaccount->name=$pid;
$transaccount->type="Banks";
$transaccount->dr=$amount;
$transaccount->cr="0";
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$phid;
$transaccount->user=$uid;
$transaccount->bank_type=$bank_id;
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }

 }
 public function cashRecoveryUpdate(Request $req){
    $inv=$req->inv;
    $pid=4;
    $rid=$req->rid;
    $amount=$req->pamount;
    $discription=$req->pdetails;
    // $date=$req->ddate;
    $type=$req->type;
    $bank_id=13;
    $uid=session('user_id');
    $phid=session('pharma_id');
    
    $product=bankRecovery::find($inv);
   
//           //  $product=new cashRecovery;
//         $product->id=$inv;
//         $product->date=$date;
//         $product->pid=$rid;
//         $product->type=$type;
//         $product->amount=$amount;
//         $product->discription=$discription;
//         $product->uid=$uid;
//         $product->pharma_id=$phid;
// $product->save();
$productcash=cashRecovery::find($inv);
$type=$productcash->type;
// return $type;
        $productcash->id=$product->id;
        // $productcash->date=$date;
        $productcash->pid=$rid;
        $productcash->type=$type;
        $productcash->amount=$amount;
        $productcash->discription=$discription;
        $productcash->uid=$uid;
        $productcash->pharma_id=$phid;
        $productcash->save();
         $type=$productcash->type;
if($type=="1"){
//   $product=new bankRecovery;
        $product->id=$inv;
        // $product->date=$date;
        $product->rid=$rid;
        $product->pid=$pid;
        $product->bank_id=$bank_id;
        $product->cr=$amount;
         $product->dr=0;
        $product->discription=$discription;
        $product->uid=$uid;
        $product->pharma_id=$phid;
}
if($type=="2"){
$product->id=$inv;
        // $product->date=$date;
        $product->rid=$rid;
        $product->pid=$pid;
        $product->bank_id=$bank_id;
        $product->cr=0;
         $product->dr=$amount;
        $product->discription=$discription;
        $product->uid=$uid;
        $product->pharma_id=$phid;
}
$product->save();
//$transaccount=new transaccount;
$transaccount=transaccount::where('type','CashRecovery')->where('inv',$inv)->first();
$transaccount->name=$rid;
$transaccount->type="CashRecovery";
if($type=="1"){
$transaccount->cr=$amount;
$transaccount->dr="0";
}
if($type=="2"){
    $transaccount->dr=$amount;
    $transaccount->cr="0";
    }
// $transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->pharma_id=$phid;
$transaccount->user=$uid;
$transaccount->bank_type="0";
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }

 }
 public function cashRecovery(Request $req){
    $inv=$req->inv;
    // $pid=$req->pid;
    $rid=$req->rid;
    $amount=$req->pamount;
    $discription=$req->pdetails;
    $date=$req->ddate;
    $type=$req->type;
    // $bank_id=$req->bank_id;
    $uid=session('user_id');
    $phid=session('pharma_id');
    //salesbook::where('id',$bid)->update(['purchase'=>$pamount]);
    // `id`, `date`, `recevier`, `pay`, `bank_id`, `amount`, `discription`, `uid
        
// $product->save();
$cash_id=book::where('name', 'like', '%cash%')->first();
$product=new bankRecovery;
if($type=="1"){
  
        $product->date=$date;
        $product->rid=4;
        $product->pid=$rid;
        $product->bank_id=13;
        $product->dr=$amount;
         $product->cr=0;
         $product->type="CashRecovery";
        $product->discription=$discription;
        $product->uid=$uid;
        $product->pharma_id=$phid;
        $product->tran_type=1;
}
if($type=="2"){
        $product->date=$date;
        $product->rid=$rid;
        $product->pid=4;
        $product->bank_id=13;
        $product->dr=0;
         $product->cr=$amount;
         $product->type="CashRecovery";
        $product->discription=$discription;
        $product->uid=$uid;
        $product->pharma_id=$phid;
        $product->tran_type=2;
}

$product->save();
$productcash=new cashRecovery;
        $productcash->id=$product->id;
        $productcash->date=$date;
        $productcash->pid=$rid;
        $productcash->type=$type;
        $productcash->amount=$amount;
        $productcash->discription=$discription;
        $productcash->uid=$uid;
        $productcash->pharma_id=$phid;
        $productcash->save();
$transaccount=new transaccount;
$transaccount->name=$rid;
$transaccount->type="CashRecovery";
if($type=="1"){
$transaccount->dr=$amount;
$transaccount->cr="0";
}
if($type=="2"){
    $transaccount->cr=$amount;
    $transaccount->dr="0";
    }
$transaccount->date=$date;
$transaccount->inv=$product->id;
$transaccount->pharma_id=$phid;
$transaccount->user=$uid;
$transaccount->bank_type=$cash_id->id;
$transaccount->save();
// $cash_id=book::where('name', 'like', '%cash%')->first();
$transaccount=new transaccount;
$transaccount->name=$cash_id->id;
$transaccount->type="CashRecovery";
if($type=="2"){
$transaccount->dr=$amount;
$transaccount->cr="0";
}
if($type=="1"){
    $transaccount->cr=$amount;
    $transaccount->dr="0";
    }
$transaccount->date=$date;
$transaccount->inv=$product->id;
$transaccount->pharma_id=$phid;
$transaccount->user=$uid;
$transaccount->bank_type=$rid;
$result=$transaccount->save();
// $transaccount->save();
// $transaccount=new transaccount;
// $transaccount->name=$pid;
// $transaccount->type="Payment";
// $transaccount->dr=$amount;
// $transaccount->cr="0";
// $transaccount->date=$date;
// $transaccount->inv=$inv;
// $transaccount->pharma_id=$phid;
// $transaccount->user=$uid;
// $transaccount->bank_type=$bank_id;

if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }

 }
 public function billRecovery(Request $req){
     $bid=$req->bid;
    $sid=salesbook::with('book')->where('id',$bid)->get();
        
    return view("recoveryBillDetails",['sid'=>$sid]);
 }
 public function salesrecovery(Request $req){
        $uid=session('user_id');
$pid=session('pharma_id');
        $sbook=salesbook::with('book')->where('pharma_id','=',$pid)->orderBy('date', 'DESC')->get();
    return view('salesrecovery',['dalysales'=>$sbook]);
 }
  public function salesinvoice(Request $req){
        $uid=session('user_id');
$pid=session('pharma_id');
        $sbook=salesbook::with('book')->where('pharma_id','=',$pid)->orderBy('date', 'DESC')->get();
       // echo $sbook;
    return view('bills',['dalysales'=>$sbook]);
 }
  public function purchaseinvoice(Request $req){
        $uid=session('user_id');
$pid=session('pharma_id');
        $sbook=purchasebook::with('book')->where('pharma_id','=',$pid)->orderBy('date', 'DESC')->get();
       // echo $sbook;
    return view('purchasebill',['dalysales'=>$sbook]);
 }
 public function salerecovery(Request $req){
$date=$req->date;
$ides=$req->coi;
foreach($ides as $value){
    echo $value;

echo $date;
salesbook::where('id',$value)->update(['status'=>'1','date'=>$date]);
}
 }
  public function fetchrecoverys(Request $req){
    
    $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=recovery::all()->last();
        $ssid=$sid['id']+1;
        $dates=$req->inv;
        $date=date("Y-m-d");
    $stx=recovery::with('book')->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
    $pros=recovery::where('pharma_id','=',$pid)->sum('amount');
    return response()->json([
        'stx'=>$stx,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
    ]);
}
public function fetchbankrecoverys(Request $req){
    
    $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=bankRecovery::all()->last();
        $ssid=$sid['id']+1;
        $dates=$req->inv;
        $date=date("Y-m-d");
    $stx=bankRecovery::with('pbook')->with('rbook')->where('date',$date)->orderBy('date','DESC')->where('pharma_id','=',$pid)->get();
    $pros=bankRecovery::where('pharma_id','=',$pid)->where('date',$date)->sum('amount');
    return response()->json([
        'stx'=>$stx,
        'pros'=>round($pros,2),
        'sid'=>$ssid,
    ]);
}
  
  public function autorecoverycustomer(Request $request)
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
    $ppid=session('pharma_id');
        $pname=$req->pname;
        $pid=$req->pid;
        $bid=$req->bid;
        $details=$req->pdetails;
        $pamount=$req->pamount;
        $gdate=$req->ddate;
         $contra=$req->contra;
       salesbook::where('id',$bid)->update(['purchase'=>$pamount]);
        $product=new recovery;
        $product->id=$pid;
        $product->date=$gdate;
         $ppidc=book::where('name',$pname)->get();
       foreach ($ppidc as $c){
           $sidx=$c['id'];
       }
$product->name=$sidx;
$product->details=$details;
$product->amount=$pamount;
$product->pharma_id=$ppid;
$product->user=$uid;
$product->save();
$transaccount=new transaccount;
$transaccount->name=$sidx;
$transaccount->type="Recovery";
$transaccount->cr=$pamount;
$transaccount->dr="0";
$transaccount->date=$gdate;
$transaccount->inv=$pid;
$transaccount->pharma_id=$ppid;
$transaccount->user=$uid;
$transaccount->bank_type=$contra;
$result=$transaccount->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
  


    }
    public function deleteCashRecovery(Request $req)
    {
        $id=$req->a;
        Transaccount::where('type', 'CashTransection')
                            ->where('inv', $id)->delete();
       $result=cashRecovery::find($id)->delete();

     if($result){
        return response()->json(['success'=>'Book deleted successfully.']);
     }else{
      return response()->json(['success'=> 'No Record To delete']);
     }
    }
    public function deleteBankRecovery(Request $req)
    {
        
        $id=$req->a;
        Transaccount::where('type', 'BankTransection')
                            ->where('inv', $id)->delete();
       $result=bankRecovery::find($id)->delete();

     if($result){
        return response()->json(['success'=>'Book deleted successfully.']);
     }else{
      return response()->json(['success'=> 'No Record To delete']);
     }
    }

    public function getCashRecoveryUpdate(Request $req){
        $inv=$req->a;
       $inv=$req->a;
            $entry=cashRecovery::with('pbook')->where('id', $inv)->first();
              $pur_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['pid'])->get();
        return response()->json(['singleEntry'=>$entry,'pur_balance'=>$pur_balance]); 
        
        //$blnc1=wholesale::getBalanceForName($entry['fid']);
       // $form_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['fid'])->get();
     
        }
        public function getBankRecoveryUpdate(Request $req){
            $inv=$req->a;
            $entry=bankRecovery::with('pbook','rbook')->where('id', $inv)->first();
            //$blnc1=wholesale::getBalanceForName($entry['fid']);
           $form_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['fid'])->get();
            $pur_balance=transaccount::select(DB::raw("SUM(cr)-SUM(dr) as blnc"))->where('name','=',$entry['pid'])->get();
            return response()->json(['singleEntry'=>$entry,'pur_balance'=>$pur_balance,'form_balance'=>$form_balance]);
            }
     public function destroy($id)
    {
        transaccount::select('*')->where([['inv','=',$id],['type','=','Recovery']])->delete();
       recovery::find($id)->delete();

     
        //return response()->json(['success'=>'Book deleted successfully.']);
        return view("recovery");
    }
}
