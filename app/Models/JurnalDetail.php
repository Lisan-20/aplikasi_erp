<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalDetail extends Model
{
    use HasFactory;

    protected $table = 'tc_erp_jurnal_detail';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function header()
    {
        return $this->belongsTo(JurnalHeader::class, 'id_jurnal_header');
    }

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'id_coa');
    }
}

