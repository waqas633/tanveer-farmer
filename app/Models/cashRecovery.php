<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cashRecovery extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function pbook()
    {
        return $this->hasOne(book::class,'id','pid');
    }
}
