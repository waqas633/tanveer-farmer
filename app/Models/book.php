<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class book extends Model
{
    // public $timestamps=false;
      protected $table = 'books';
    protected $softDelete = true;
    use SoftDeletes;
    use HasFactory;
}
