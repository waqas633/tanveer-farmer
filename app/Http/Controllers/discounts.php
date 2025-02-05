<?php

namespace App\Http\Controllers;
use App\Models\discount;
use App\Models\town;
use App\Models\book;
use App\Models\company;
use App\Models\cogroup;
use App\Models\expenseHead;
use Illuminate\Http\Request;

class discounts extends Controller
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
     public function deleteHead(Request $req)
    {
        $id=$req->a;
       expenseHead::find($id)->delete();
     
        return response()->json(['success'=>'Head deleted successfully.']);
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
  public function fetchhead(Request $req){
        $var=expenseHead::all();
        $var1=expenseHead::all();
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
 //  public function addcompany(Request $req){
 //   $uid=session('user_id');
 //   $pid=session('pharma_id');
   // $var=company::all();
//    $product=new company;
//$product->name=$req->item;
//$result=$product->save();
//if($result){
  //      return response()->json(['success'=>'Company Added successfully.','var'=>$var]);
    //    }
   //}
   public function addHead(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    $var=expenseHead::all();
    $product=new book;
$product->name=$req->item;
$product->phone="0";
$product->phone1="0";
$product->address="0";
$product->address1="0";
$product->pmdc="0";
$product->ntn="0";
$product->acc="0";
$product->acc1="0";
$product->area="0";
$product->type="Farm Expenses";
$product->pharma_id=$pid;
$product->user=$uid;
$product->save();
$lastInsertedId = $product->id;
    $product=new expenseHead;
    $product->id=$lastInsertedId;  
$product->name=$req->item;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Head Added successfully.','var'=>$var]);
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
