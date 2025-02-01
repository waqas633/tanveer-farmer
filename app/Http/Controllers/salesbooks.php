<?php

namespace App\Http\Controllers;
use App\Models\salesbook;
use App\Models\transaccount;
use Illuminate\Http\Request;

class salesbooks extends Controller
{
    public function viewbooks(Request $req){
         $pid=session('pharma_id');
         $sid=$req->inv;
         $invid=$req->invc;
        //  return $invid;
        if($invid==""){
             $sbook=salesbook::with('book')->where('name',$sid)->where('pharma_id','=',$pid)->orderBy('date', 'DESC')->get();
        return response()->json([
        'sbook'=>$sbook,
    ]);
        }else{
        $sbook=salesbook::with('book')->where('id','=',$invid)->orderBy('date', 'DESC')->get();
        return response()->json([
        'sbook'=>$sbook,
    ]);
        }
    }
    public function addNew(Request $req){
        $pid=session('pharma_id');
         $sid=$req->pid;
        $sbook=salesbook::with('book')->where('name',$sid)->where('pharma_id','=',$pid)->get();
       return response()->json(['success'=>'Book saved successfully.',$sbook]);
      //  $salesbook=new salesbook;
//        $salesbook->name=$req->pid;
  //      $salesbook->sale="0";
    //    $salesbook->purchase="0";
      //  $salesbook->discount="0";
        //$salesbook->balnce="0";
 //       $salesbook->date=date("Y-m-d");
   //     $salesbook->time=date("h:i:sa");
     //   $salesbook->pharma_id=session('pharma_id');
       // $salesbook->user=session('user_id');
//        $salesbook->recevier=$req->pdetails;
  //      $salesbook->deliveryBoy=$req->pname;
    //   $result=$salesbook->save();
      // $inv=$salesbook->id;
//if($result){
 //    $transaccount=new transaccount;
//$transaccount->name=$req->pid;
//$transaccount->type="Sales";
//$transaccount->cr="0";
//$transaccount->dr="0";
//$transaccount->date=date("Y-m-d");;
//$transaccount->inv=$inv;
//$transaccount->user=session('user_id');
//$transaccount->pharma_id=session('pharma_id');
//$transaccount->save();
       //  return response()->json(['success'=>'Book saved successfully.']);
    ///    }
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
        $date=date("Y-m-d");
        $time=date("h:i:sa");
        $transaccount=new transaccount;
$transaccount->name=$party;
$transaccount->type="Sales";
$transaccount->cr=$cas;
$transaccount->dr=$tot;
$transaccount->date=$date;
$transaccount->inv=$inv;
$transaccount->user=$uid;
$transaccount->pharma_id=$pid;
$transaccount->save();
        $product=new salesbook;
$product->id=$inv;
$product->name=$party;
$product->sale=$tot;
$product->purchase=$cas;
$product->discount=$disco;
$product->balnce=$netcas;
$product->date=$date;
$product->time=$time;
$product->user=$uid;
$product->pharma_id=$pid;
        $result=$product->save();
if($result){
         return response()->json(['success'=>'Book saved successfully.']);
        }
 }
}
