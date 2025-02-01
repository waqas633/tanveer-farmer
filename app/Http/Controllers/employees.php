<?php

namespace App\Http\Controllers;
use App\Models\company;
use App\Models\cogroup;
use App\Models\employee;
use Illuminate\Http\Request;

class employees extends Controller
{
   public function deleteEmployee(Request $req)
    {
        $id=$req->a;
       employee::find($id)->delete();
     
        return response()->json(['success'=>'Employee deleted successfully.']);
    }
     public function fetchEmployee(Request $req){
        $var=company::all();
        $var1=cogroup::all();
        $var2=employee::all();
    return response()->json([
        'var'=>$var,
        'var1'=>$var1,
        'var2'=>$var2,
    ]);
  }
   public function addEmployee(Request $req){
    $var=employee::all();
    $product=new employee;
$product->company=$req->itemCompany;
$product->cgroup=$req->itemGroup;
$product->name=$req->itemEmployee;
$product->phone=$req->itemPhone;
$result=$product->save();
if($result){
        return response()->json(['success'=>'Employee Added successfully.','var'=>$var]);
        }
   }
}
