<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesreturnsbook extends Model
{
    public $timestamps=false;
    use HasFactory;
       public function saleproduct()
    {
        return $this->hasOneThrough(sale::class,product::class,'name','id','name','inv');
     // return $this->through(sale::class,'inv','id')->has(product::class,'id','name');
      
    }
     public function book()
    {
        return $this->hasmany(book::class,'id','name');
     // return $this->through(sale::class,'inv','id')->has(product::class,'id','name');
      
    }
       public function book1()
    {
        return $this->hasOne(book::class,'id','name');
     // return $this->through(sale::class,'inv','id')->has(product::class,'id','name');
      
    }
     public function product()
    {
        return $this->hasOne(product::class,'id','name');
    }
}
