<?php

namespace App\Http\Controllers;
use App\Models\account;
use App\Models\accountType;
use App\Models\purchase;
use App\Models\purchasereturn;
use App\Models\recovery;
use App\Models\booker;
use App\Models\sale;
use App\Models\transaccount;
use App\Models\User;
use App\Models\salesreturn;
use App\Models\salary;
use App\Models\town;
use App\Models\book;
use App\Models\letterhead;
use App\Models\payment;
use App\Models\salesbook;
use Illuminate\Http\Request;

class books extends Controller
{
    
   public function dashboard(){
     $uid=session('user_id');
      $date=date("Y-m-d");
        $pid=session('pharma_id');
        $sal=salesbook::where('date', '=', $date)->where('pharma_id','=',$pid)->where('status','2')->sum('sale');
        $pru=purchase::where('created_at', '=', $date)->where('pharma_id','=',$pid)->sum('purchase');
        $rec=recovery::where('date', '=', $date)->where('pharma_id','=',$pid)->sum('amount');
        $pay=payment::where('date', '=', $date)->where('pharma_id','=',$pid)->sum('amount');
      $salr=salesreturn::where('created_at', '=', $date)->where('pharma_id','=',$pid)->sum('price');
        $prur=purchasereturn::where('created_at', '=', $date)->where('pharma_id','=',$pid)->sum('purchase');
        $slr=salary::where('date', '=', $date)->where('pharma_id','=',$pid)->sum('amount');
        $usr=User::where('status','=','1')->where('pharma_id','=',$pid)->count();
        $ltrhd=letterhead::all()->last();;
    return response()->json([
        'sal'=>round($sal,0),
        'pru'=>round($pru,2),
        'salr'=>round($salr,0),
        'prur'=>round($prur,2),
        'rec'=>round($rec,2),
        'pay'=>round($pay,2),
        'slr'=>round($slr,0),
        'usr'=>$usr,
        'ltrhd'=>$ltrhd['name'],
    ]);
   }
public function fetchtown(Request $req){
     $uid=session('user_id');
        $pid=session('pharma_id');
        // $stx=town::all();
        // $acctype=accountType::all();
        // $accts=book::all();
        // $booker=booker::Select('name')->where('pharma_id','=',$pid)->where('type', '=', 'booker')->get();
        date_default_timezone_set("Asia/Karachi");
        $date=date("Y-m-d");
        $acc_type=accountType::all();
        $accs=transaccount::with('book')
        ->where('type',"AccountOpening")
        // ->groupBy('name')
                     ->get();
                     $bookz=book::all();
        return view('customerentry',['acc_type'=>$acc_type,'accs'=>$accs,'datrate'=>$date,'bookz'=>$bookz]); 
  }
  public function fetchupdate(Request $req){
     $uid=session('user_id');
        $pid=session('pharma_id');
        $stx=town::all();
        $booker=booker::Select('name')->where('pharma_id','=',$pid)->where('type', '=', 'booker')->get();
        return view('updatecustomer',['stx'=>$stx,'booker'=>$booker]); 
  }
   public function fetchpurchaselist(Request $req){
     $uid=session('user_id');
        $pid=session('pharma_id');
        $stx=book::where('pharma_id','=',$pid)->get();
    return response()->json([
        'stx'=>$stx,
    ]);
  }
   function addproduct(Request $req){
       $pid=session('pharma_id');
       $uid=session('user_id');
       date_default_timezone_set("Asia/Karachi");
       $date=date("Y-m-d");
$values=$req->type;
$product=new book;
$product->name=$req->itemName;
$product->phone=$req->phone;
$product->phone1=$req->phone1;
$product->address=$req->address;
$product->address1=$req->address1;
$product->pmdc=$req->phone2;
$product->ntn=$req->phone3;
$product->acc=$req->account1;
$product->acc1=$req->account2;
$product->area="0";
$product->type=$req->acctype;
$product->pharma_id=$pid;
$product->user=$uid;
$result=$product->save();
$item=new transaccount;
$item->name=$product->id;
$item->type="AccountOpening";
if($values=="cr"){
  $item->cr=$req->balance;
$item->dr="0";
}
if($values=="dr"){
  $item->dr=$req->balance;
$item->cr="0";
}
$item->date=$date;
$item->inv="0";
$item->pharma_id=$pid;
$item->user=$uid;
$item->bank_type="0";
$result=$item->save();

if($result){
        return redirect('/customer');
        }
    }
    function updatebooks(Request $req){
      $pid=session('pharma_id');
      $uid=session('user_id');
      date_default_timezone_set("Asia/Karachi");
      $date=date("Y-m-d");
      $inv=$req->pinv;
$values=$req->type;
$product=book::where('id', $inv)->first();
$product->name=$req->itemName;
$product->phone=$req->phone;
$product->phone1=$req->phone1;
$product->address=$req->address;
$product->address1=$req->address1;
$product->pmdc=$req->phone2;
$product->ntn=$req->phone3;
$product->acc=$req->account1;
$product->acc1=$req->account2;
$product->area="0";
$product->type=$req->acctype;
$product->pharma_id=$pid;
$product->user=$uid;
$product->save();
$item=transaccount::where("type","AccountOpening")->where("name",$inv)->first();
if($values=="cr"){
 $item->cr=$req->balance;
$item->dr="0";
}
if($values=="dr"){
 $item->dr=$req->balance;
$item->cr="0";
}
$item->date=$date;
$item->inv="0";
$result=$item->save();

if($result){
       return redirect('/customer');
       }
   }
    function addproductfromsales(Request $req){
       $pid=session('pharma_id');
       $uid=session('user_id');
$product=new book;
$product->name=$req->party;
$product->phone=$req->phone;
$product->phone1='0';
$product->address=$req->address;
$product->address1='0';
$product->pmdc='0';
$product->ntn='0';
$product->acc='0';
$product->acc1='0';
$product->area='0';
$product->type='0';
$product->pharma_id=$pid;
$product->user=$uid;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Customer Added successfully.']);
        }
    }
     function updateproduct(Request $req){
$name=$req->name;
$phone1=$req->phone1;
$phone=$req->phone;
$address=$req->address;
$address1=$req->address1;
$pmdc=$req->pmdc;
$ntn=$req->ntn;
$type=$req->type;
$acc1=$req->acc1;
$acc=$req->acc;
$refer=$req->refer;
$area=$req->area;
$pid=$req->pid;
$result=book::select('books')
                ->where('id',$req->pid)
                ->update(['name'=>$name,'phone'=>$phone,'phone1'=>$phone1,'address'=>$address,'address1'=>$address1,'pmdc'=>$pmdc,'ntn'=>$ntn,'type'=>$type,'acc1'=>$acc1,'area'=>$area,'refer'=>$refer,'acc'=>$acc]);
if($result){
        return $result;
        }
//$result=$product->save();
    }
public function destroy($id)
    {
       book::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
     public function fetchrate(Request $req){
        $pros=$req->search; $uid=session('user_id');
        $pid=session('pharma_id');
        $sid=book::select('*')->where([['name','=',$pros]])->first();
        $phone=$sid['phone'];
        $phone1=$sid['phone1'];
        $address=$sid['address'];
        $address1=$sid['address1'];
        $pmdc=$sid['pmdc'];
        $ntn=$sid['ntn'];
        $acc=$sid['acc'];
        $acc1=$sid['acc1'];
        $pid=$sid['id'];
        $refer=$sid['refer'];
        $type=$sid['type'];
        $area=$sid['area'];
    return response()->json([
        'phone'=>$phone,
        'phone1'=>$phone1,
        'address'=>$address,
        'address1'=>$address1,
         'pmdc'=>$pmdc,
        'ntn'=>$ntn,
        'type'=>$type,
        'acc'=>$acc,
         'pid'=>$pid,
        'acc1'=>$acc1,
        'refer'=>$refer,
        'area'=>$area
    ]);
  }
}
