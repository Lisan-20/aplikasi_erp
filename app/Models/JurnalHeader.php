<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalHeader extends Model
{
    use HasFactory;

    protected $table = 'tc_erp_jurnal_header';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(JurnalDetail::class, 'id_jurnal_header');
    }

    public function user()
    {
        return $this->belongsTo(DdUser::class, 'id_dd_user', 'id_dd_user');
    }
}

