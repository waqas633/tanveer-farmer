<?php

namespace App\Http\Controllers;
use App\Models\discount;
use App\Models\town;
use App\Models\company;
use App\Models\cogroup;
use App\Models\brand;
use App\Models\item;
use App\Models\stock;
use DB;
use Illuminate\Http\Request;

class brands extends Controller
{
 public function search(Request $req){
     $item=$req->search;
     $var=brand::where('group_id',$item)->get();
      return response()->json([
        'var'=>$var,
    ]);
 }
 public function demention(Request $req){
     $itz=$req->search;
    $var=item::groupBy('size')->where('brand_id',$itz)->get();
   // $results = $item->item()
     //       ->groupBy('items.size')  
       //     ->get();
      // $results=DB::select('select * from items where brand_id="$itz" group by size');
      return response()->json([
        'var'=>$var,
    ]);
 }
  public function thikness(Request $req){
     $item=$req->search;
     $item2=$req->search1;
     $var=item::where('brand_id',$item)->where('size',$item2)->orderBy('thikness', 'ASC')->get();
      return response()->json([
        'var'=>$var,
    ]);
 }
 public function prod_stock(Request $req){
     $item=$req->search;
     $pid=session('pharma_id');
     $var=item::with('brand')->with('brand.group')->where('id',$item)->get();
     $stk=stock::with('item','item.brand','item.brand.group')->select('*')->where('pharma_id','=',$pid)->where([['name',$item]])->get();
      $pros1=stock::where([['name',$item]])->where('pharma_id','=',$pid)->sum('units') ?? 0;
      return response()->json([
        'var'=>$var,
        'stk'=>$stk,
        'pros1'=>$pros1,
    ]);
 }
   public function delete(Request $req)
    {
        $id=$req->a;
       brand::find($id)->delete();
     
        return response()->json(['success'=>'Brand deleted successfully.']);
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
        $var=brand::all();
        $var1=brand::all();
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
     $product=new brand;
$product->name=$req->item;
$product->series=$req->series;
$product->waranty=$req->wrnt;
$product->group_id=$req->series;
$result=$product->save();
$var=brand::all();
if($result){
        return response()->json(['success'=>'Brand Added successfully.','var'=>$var]);
        }
   }
   public function addcogroup(Request $req){
    $uid=session('user_id');
    $pid=session('pharma_id');
    $var=cogroup::all();
    $product=new cogroup;
$product->company=$req->item;
$product->cgroup=$req->itemGroup;
$product->waranty=$req->wrnt;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Group Added successfully.','var'=>$var]);
        }
   }
}
