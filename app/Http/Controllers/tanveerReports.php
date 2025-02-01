<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accountType;
use App\Models\localsale;
use App\Models\wholesale;
use App\Models\transaccount;
use App\Models\rate;
use Carbon\Carbon;
use DB;
class tanveerReports extends Controller
{
  public function wholesale(Request $request)
    {
      date_default_timezone_set("Asia/Karachi");
      $date=date("Y-m-d");
      $acc_type=accountType::all();
      $ratz=rate::all();
      $wholesaless=wholesale::where("date",$date)->with('pbook')->with('rbook')->get();
      $accs=transaccount::select('name',DB::raw('SUM(cr) - SUM(dr) as balance'))->with('book')
                   ->groupBy('name')
                   ->get();
      $date=rate::where("date",$date)->first();
      return view('reportone',['acc_type'=>$acc_type,'ratz'=>$ratz,'accs'=>$accs,'datrate'=>$date,'wholesaless'=>$wholesaless]);
    }
}
