<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class wholesale extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function pbook()
    {
        return $this->hasOne(book::class,'id','pid');
    }
    public function rbook()
    {
        return $this->hasOne(book::class,'id','fid');
    }
    public static function getBalanceForName($name)
    {
        return self::select(DB::raw('(select SUM(cr) - SUM(dr) as blnc from `transaccounts` where `name` = ' . $name . ') as `blnc`'))->get();
    }
}
