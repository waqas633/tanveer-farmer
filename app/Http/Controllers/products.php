<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cogroup;
use App\Models\stock;
use App\Models\item;
use PDF;
class products extends Controller
{
    public function downloadPDF(){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
        $var=stock::with('product')->where('pharma_id','=',$pid)->get();
 $pdf = PDF::loadView('yourpage');
    
        return $pdf->download('stockreport.pdf');
    }
    public function index(Request $request)
    {
            return view('entryproducts');
    }
    function addproduct(Request $req){
$product=new product;
$product->name=$req->itemName;
$product->formula=$req->itemformula;
$product->price=$req->itemPrice;
$product->purchase=$req->itemPurchase;
$product->pack=$req->quantity;
$product->distribution=$req->itemdistribution;
$product->company=$req->itemCompany;
$product->type=$req->itemType;
$product->cogroup=$req->groupCompany;

$result=$product->save();
if($result){
        return redirect('/entryproducts');
        }
    }
    function show(){
        $pros=product::all();
    return view('entryproducts',['pros'=>$pros]);
    }
     function showstock(){
         
        
    $uid=session('user_id');
    $pid=session('pharma_id');
       // $var=stock::with('product','purchase','sale')->where('pharma_id','=',$pid)->get();
       // $var->load('item','item.brand','item.brand.group');
       // $units=stock::where('pharma_id','=',$pid)->sum('units');
       // $price=stock::where('pharma_id','=',$pid)->sum('price');
       $var=item::with('stock','purchase1','sale')->get();
       $var->load('brand','brand.group');
       
       $units=stock::where('pharma_id','=',$pid)->sum('units');
       $price=stock::where('pharma_id','=',$pid)->sum('price');
       
       
   return view('stockreport',[
        'var'=>$var,
        'price'=>round($price,2),
        'units'=>$units,
    ]);     
  //  $uid=session('user_id');
//    $pid=session('pharma_id');
  //      $var=stock::with('product')->where('pharma_id','=',$pid)->get();
//        $units=stock::where('pharma_id','=',$pid)->sum('units');
  //      $price=stock::where('pharma_id','=',$pid)->sum('price');
  // return view('stockreport',['var'=>$var,'price'=>$price]);
    }
     function activestock(){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
       // $var=stock::with('product','purchase','sale')->where('pharma_id','=',$pid)->get();
       // $var->load('item','item.brand','item.brand.group');
       // $units=stock::where('pharma_id','=',$pid)->sum('units');
       // $price=stock::where('pharma_id','=',$pid)->sum('price');
       $var=item::with('stock','purchase1','sale','availbilitysale','salesreturn')->get();
       $var->load('brand','brand.group');
       
       $units=stock::where('pharma_id','=',$pid)->sum('units');
       $price=stock::where('pharma_id','=',$pid)->sum('price');
       
       
   return view('stockview',[
        'var'=>$var,
        'price'=>round($price,2),
        'units'=>$units,
    ]);
    }
    function showsingle(Request $req){
        $pros=product::select('*')->where([['id','=',$req->id]])->first();
        echo $pros['name'];
    return view('updateproduct',['u'=>$pros]);
    }
     function updateproduct(Request $req){
$product=new product;
$name=$req->name;
$formula=$req->formula;
$price=$req->price;
$purchase=$req->purchase;
$pack=$req->quantity;
$distribution=$req->distribution;
$company=$req->company;
$type=$req->type;
$cogroup=$req->cogroup;
product::select('products')
                ->where('id',$req->pid)
                ->update(['name'=>$name,'formula'=>$formula,'price'=>$price,'purchase'=>$purchase,'pack'=>$pack,'distribution'=>$distribution,'company'=>$company,'type'=>$type,'cogroup'=>$cogroup]);
//$result=$product->save();
    }
    
    function deleteproduct(Request $req){
$product=new product;
echo $req->id;
$result=product::select('id')
                ->where([['id','=',$req->id]])
                ->delete();
//$result=$product->save();
if($result){
        return redirect('/show');
       }
    }
    public function fetchstudent(Request $req){
        $stx1=product::Select('name')->get();
    return response()->json([
       
        'stx1'=>$stx1,
        
    ]);
  }
   public function destroy($id)
    {
       product::find($id)->delete();
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }
}
