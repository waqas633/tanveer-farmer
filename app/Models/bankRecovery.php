<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankRecovery extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function pbook()
    {
        return $this->hasOne(book::class,'id','pid');
    }
    public function rbook()
    {
        return $this->hasOne(book::class,'id','rid');
    }
    public function bank()
    {
        return $this->hasOne(bank::class,'id','bank_id');
    }
    public function genralEntries()
    {
        return $this->hasMany(transaccount::class,'inv','id')->whereIn('type',['Banks', 'CashRecovery','Expenses']);
    }
}
