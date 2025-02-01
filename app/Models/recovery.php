<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recovery extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function book()
    {
        return $this->hasmany(book::class,'id','name');
     // return $this->through(sale::class,'inv','id')->has(product::class,'id','name');
      
    }
}
