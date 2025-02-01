<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchasebook extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function book()
    {
        return $this->hasmany(book::class,'id','name');
     // return $this->through(sale::class,'inv','id')->has(product::class,'id','name');
      
    }
}
