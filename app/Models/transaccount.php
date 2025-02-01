<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaccount extends Model
{
     public $timestamps=false;
    use HasFactory;
    public function book()
    {
        return $this->hasOne(book::class,'id','name');
    }
    public function sale()
    {
       // return $this->hasMany(sale::class,'inv','inv','name','party');
       return $this->hasMany(sale::class)->where('inv',$transaccount->inv);
    }
     public function bankRequires()
    {
       // return $this->hasMany(sale::class,'inv','inv','name','party');
       return $this->hasOne(bankRecovery::class,'id','inv');
    }
}
