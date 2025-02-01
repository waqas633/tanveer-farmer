<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class availbilitysale extends Model
{
     public function product()
    {
        return $this->hasOne(product::class,'id','name');
    }
      public function item()
    {
        return $this->hasOne(item::class,'id','name');
    }
    public function availbilitybooks()
    {
        return $this->hasOne(book::class,'id','party');
    }
     
    protected $fillable = [
        'name', 'price'
    ];
    public $timestamps=false;
    
    use HasFactory;
}
