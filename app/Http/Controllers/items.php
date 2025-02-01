<?php

namespace App\Http\Controllers;
use App\Models\discount;
use App\Models\town;
use App\Models\company;
use App\Models\cogroup;
use App\Models\brand;
use App\Models\item;
use Illuminate\Http\Request;

class items extends Controller
{
    public function index(Request $request)
    {
           $ax="";
        $brand=brand::all();
         $brnding=item::where([['brand_id','50'],['size','12x12'],['thikness','3']])->first();
        //  foreach($brnding as $sty){
   //  $ax=$sty['id'];
 //}
            return view('items',['brand'=>$brand,'branding'=>$brnding]);
    }
      function addproduct(Request $req){
          //$request->get('jobPriority');
          $ax="";
          $brndingz=item::where([['brand_id',$req->get('brand_id')],['size',$req->itemSize],['thikness',$req->itemThikness]])->first();
  
if($brndingz==NULL){
$product=new item;
$product->brand_id=$req->brand_id;
$product->size=$req->itemSize;
$product->thikness=$req->itemThikness;
$product->units=$req->packing;
$product->date=date("Y-m-d");
$product->tp=$req->purchase;
$product->mrp=$req->sale;
$result=$product->save();
if($result){
        return redirect('/items');
       // return response()->json(['success'=>'Discount deleted successfully.']);
        }
}
else{
     return redirect('/items');
  //  return redirect('/items',['success'=>'Duplicated Product.']);
}
    }
      function updateitem(Request $req){
$product=new item;
$price=$req->tp;
$purchase=$req->mrp;
$pack=$req->units;
//product::select('items')
$result=item::where('id',$req->search)->update(['mrp'=>$price,'tp'=>$purchase,'units'=>$pack]);
                if($result){
        return response()->json(['success'=>'Item Updated Successfully.']);
        }
//$result=$product->save();
    }
 
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
