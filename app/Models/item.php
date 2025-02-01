<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function brand()
    {
        return $this->hasOne(brand::class,'id','brand_id');
    }
    public function group()
    {
        return $this->hasOne(group::class);
    }
     public function purchase()
    {
        return $this->hasOne(purchase::class,'name','name')->SUM('units');
    }
     public function sale()
    {
        return $this->hasMany(sale::class,'name','id')->SUM('units');
    }
    public function salesreturn()
    {
        return $this->hasMany(salesreturn::class,'name','id')->SUM('units');
    }
    //availbilitysale
     public function availbilitysale()
    {
        return $this->hasMany(availbilitysale::class,'name','id')->SUM('units');
    }
    public function purchase1()
    {
        return $this->hasMany(purchase::class,'name','id')->SUM('units');
    }
     public function stock()
    {
        return $this->hasMany(stock::class,'name','id')->SUM('units','price');
    }
}
