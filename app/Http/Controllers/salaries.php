<?php

namespace App\Http\Controllers;
use App\Models\booker;
use App\Models\salary;
use App\Models\transaccount;
use Illuminate\Http\Request;

class salaries extends Controller
{
    public function delete(Request $req)
    {
        $id=$req->a;
       salary::find($id)->delete();
       transaccount::where([['inv','=',$id] , ['type','=','Salary']])->delete();
     
        return response()->json(['success'=>'Deleted successfully.']);
    }
    //
    public function fetchstart(){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
        $booking=booker::where('pharma_id','=',$pid)->get();
        return view('salary',['booking'=>$booking]);

    }
    public function salarynames(Request $req){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
        $party=$req->party;
$booking=booker::where('status','=','1')->where('pharma_id','=',$pid)->get();
$booking1=booker::where('name','=',$party)->where('pharma_id','=',$pid)->get();
$paymonth=date('Y-m',strtotime("-1 month"));
$bookings=salary::where('month','=',$paymonth)->where('pharma_id','=',$pid)->get();
$bookings1=salary::where('month','=',$paymonth)->where('pharma_id','=',$pid)->sum('amount') ?? 0;
         return response()->json([
        'booking'=>$booking,
        'bookings'=>$bookings,
        'bookings1'=>$bookings1,
    ]);     
    }
     function addSalary(Request $req){
        
    $uid=session('user_id');
    $pid=session('pharma_id');
$product=new salary;
$product->name=$req->itemName;
$product->fname=$req->itemFather;
$product->designation=$req->itemDeport;
$product->month=$req->itemMonth;
$product->date=$req->itemDate;
$product->user=$req->itemUser;
$product->amount=$req->itemSalary;
$product->pharma_id=$pid;
$product->user=$uid;
$sallas=salary::all()->last();
$inv=$sallas['id']+1;
$product->save();
$transaccount=new transaccount;
$transaccount->name=$req->itemName;
$transaccount->type="Salary";
$transaccount->cr='0';
$transaccount->dr=$req->itemSalary;
$transaccount->date=$req->itemDate;
$transaccount->inv=$inv;
$transaccount->user=$uid;
$transaccount->pharma_id=$pid;
$result=$transaccount->save();
$paymonth=date('Y-m',strtotime("-1 month"));
$booking1=salary::where('month','=',$paymonth)->where('pharma_id','=',$ppid)->get();
        
if($result){
     return response()->json([
        'booking1'=>$booking1,
    ]); 
    echo "<script type='text/javascript'>alert('Employee Added successfully')</script>";
        }
    }
}
