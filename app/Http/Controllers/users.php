<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\letterhead;
use Illuminate\Http\Request;
use Session;
class users extends Controller
{
    public function destroy(Request $req)
    {
        $ids=$req->id;
       user::find($ids)->delete();
        //return response()->json(['success'=>'Book deleted successfully.']);
         $var=user::all();
   return view('createuser',['var'=>$var]);
    }
    public function updateuser(Request $req){
       $item=$req->item; 
       $itemName=$req->itemName; 
       $result=user::where('name', $itemName)->update(['password'=>$item]);
       if($result){
         return response()->json(['success'=>'Password Uploaded Successfully.']);
        }
    }
    public function adduser(Request $req){
         $uid=session('user_id');
        $pid=session('pharma_id');
       $item=$req->item; 
       $itemName=$req->itemName;
       $itemType=$req->itemType;

$product=new user;
$product->name=$itemName;
$product->password=$item;
$product->type=$itemType;
$product->user_id=$uid;
$product->pharma_id=$pid;
$product->status='1';
$result=$product->save();
       if($result){
         return response()->json(['success'=>'User Added Successfully.']);
        }
    }
   public function login(Request $req){
$name=$req->name;
$password=$req->password;
$result=User::where([['name', $name],['password',$password]])->first();
$lth=letterhead::where('id',$result->pharma_id)->first();
if($result){
    $uid=$result['pharma_id'];
    $userid=$result['id'];
        $req->session()->put('user',$name);
        $req->session()->put('pharma_id',$uid);
        $req->session()->put('user_id',$userid);
        $req->session()->put('firm_name',$lth->name);
        //Session::set('user', $name);
        

         return redirect('/welcome');
      }else{
        return redirect('/');
      }
   }
   public function logout(Request $req){

        $name=session('user');
        $uid=session('pharma_id');
        $user_id=session('user_id');
        $req->session()->pull('user',$name);
        $req->session()->pull('user_id',$user_id);
        $req->session()->pull('pharma_id',$uid);
        //Session::set('user', $name);
       // echo session('user');
         return redirect('/');
      
   }
    function showuser(){
        $var=user::all();
   return view('createuser',['var'=>$var]);
    }
}
