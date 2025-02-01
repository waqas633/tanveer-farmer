<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    public $timestamps=false;
    use HasFactory;
     public function group()
    {
        return $this->hasOne(group::class,'id','group_id');
    }
}
