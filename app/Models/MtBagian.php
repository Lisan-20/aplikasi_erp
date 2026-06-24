<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtBagian extends Model
{
    use HasFactory;

    protected $table = 'mt_bagian';
    public $timestamps = false;
    protected $guarded = [];
}
