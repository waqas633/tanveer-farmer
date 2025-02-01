<?php

namespace App\Http\Controllers;
use App\Models\discount;
use App\Models\town;
use App\Models\company;
use App\Models\cogroup;
use Illuminate\Http\Request;

class expenses extends Controller
{
 
   public function delete(Request $req)
    {
        $id=$req->a;
       discount::find($id)->delete();
     
        return response()->json(['success'=>'Discount deleted successfully.']);
    }
    public function deleteTown(Request $req)
    {
        $id=$req->a;
       town::find($id)->delete();
     
        return response()->json(['success'=>'Discount deleted successfully.']);
    }
     public function deleteCompany(Request $req)
    {
        $id=$req->a;
       company::find($id)->delete();
     
        return response()->json(['success'=>'Discount deleted successfully.']);
    }
    public function deleteCogroup(Request $req)
    {
        $id=$req->a;
       cogroup::find($id)->delete();
     
        return response()->json(['success'=>'Discount deleted successfully.']);
    }
     public function fetchtown(Request $req){
        $var=town::all();
    return response()->json([
        'var'=>$var,
    ]);
  }
  public function fetchcompany(Request $req){
        $var=company::all();
        $var1=cogroup::all();
    return response()->json([
        'var'=>$var,
        'var1'=>$var1,
    ]);
  }
   public function addDiscount(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    $var=discount::all();
    $product=new discount;
$product->item=$req->item;
$product->party=$req->party;
$product->discount=$req->discount;
$product->Company=$req->company;
$product->startDate=$req->sdate;
$product->endDate=$req->edate;
$product->bill=$req->bid;
$product->user=$uid;
$product->date=$req->sdate;
$product->status='1';
$product->pharma_id=$pid;
$result=$product->save();
if($result){
        return response()->json(['success'=>'item Added successfully.','var'=>$var]);
        }
   }
   public function addTown(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    $var=town::all();
    $product=new town;
$product->name=$req->item;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Town Added successfully.','var'=>$var]);
        }
   }
   public function addcompany(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    $var=company::all();
    $product=new company;
$product->name=$req->item;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Company Added successfully.','var'=>$var]);
        }
   }
   public function addcogroup(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    $var=cogroup::all();
    $product=new cogroup;
$product->company=$req->item;
$product->cgroup=$req->itemGroup;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Group Added successfully.','var'=>$var]);
        }
   }
}
