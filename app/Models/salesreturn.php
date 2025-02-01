<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salesreturn extends Model
{
     public $timestamps=false;
     protected $fillable = ['name'];
    use HasFactory;
    public function product()
    {
        return $this->hasOne(product::class,'id','name');
    }
      public function item()
    {
        return $this->hasOne(item::class,'id','name');
    }
    public function books()
    {
        return $this->hasOne(book::class,'id','party');
    }
}
