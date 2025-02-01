<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    public $timestamps=false;
    use HasFactory;
     public function product()
    {
        return $this->hasOne(product::class,'id','name');
    }
     public function purchase()
    {
        return $this->hasOne(purchase::class,'name','name')->SUM('units');
    }
     public function sale()
    {
        return $this->hasOne(sale::class,'name','name')->SUM('units');
    }
      public function item()
    {
        return $this->hasOne(item::class,'id','name');
    }
}
