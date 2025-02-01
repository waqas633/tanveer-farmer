<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function expenseHead()
    {
        return $this->hasOne(expenseHead::class,'id','expenseHead_id');
    }
}
