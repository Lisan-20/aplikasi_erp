<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DdUser extends Model
{
    protected $table = 'dd_user';
    protected $primaryKey = 'id_dd_user';
    public $timestamps = false;
    protected $guarded = [];
}
