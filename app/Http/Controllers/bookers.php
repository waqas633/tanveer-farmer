<?php

namespace App\Http\Controllers;
use App\Models\booker;
use App\Models\town;
use Illuminate\Http\Request;

class bookers extends Controller
{
    public function fetchtown(Request $req){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
        $id=$req->id;
        $stx=town::all();
        $booking=booker::where('pharma_id','=',$pid)->get();
        
        $booker=booker::Select('name')->where('pharma_id','=',$pid)->get();
        $booker1=booker::where('id',$id)->where('pharma_id','=',$pid)->get();
        return view('bookers',['stx'=>$stx,'booker'=>$booker,'booker1'=>$booker1,'booking'=>$booking]);
   
  }
  function addEmployee(Request $req){
    
    $uid=session('user_id');
        $pid=session('pharma_id');
$product=new booker;
$product->name=$req->itemName;
$product->fname=$req->itemfather;
$product->area=$req->itemarea;
$product->phone=$req->itemPhone;
$product->phone1=$req->itemPhone1;
$product->address=$req->itemAddress;
$product->salary=$req->itemSalary;
$product->cnic=$req->cnic;
$product->date=$req->itemDate;
$product->type=$req->itemType;
$product->user=$uid;
$product->pharma_id=$pid;
$result=$product->save();
if($result){
    echo "<script type='text/javascript'>alert('Employee Added successfully')</script>";
        return redirect('/bookers');
        }
    }
    function updateEmployee(Request $req){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
        $id=$req->tid;

$name=$req->itemName1;
$fname=$req->itemfather1;
$area=$req->itemarea1;
$phone=$req->itemPhone2;
$phone1=$req->itemPhone3;
$address=$req->itemAddress1;
$salary=$req->itemSalary1;
$cnic=$req->cnic1;
$date=$req->itemDate1;
$type=$req->itemType1;
$status=$req->itemType2;

$result=booker::where('id', $id)->update(['name'=>$name,'fname'=>$fname,'area'=>$area,'phone'=>$phone,'phone1'=>$phone1,'address'=>$address,'salary'=>$salary,'cnic'=>$cnic,'date'=>$date,'type'=>$type,'status'=>$status,'user'=>$uid,'pharma_id'=>$pid]);
if($result){
    echo "<script type='text/javascript'>alert('Employee Added successfully')</script>";
        return redirect('/bookers');
        }
    }
}
