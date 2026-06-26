<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengadaan\TcErpPo;

class TcErpPenerimaan extends Model
{
    use HasFactory;
    protected $table = "tc_erp_penerimaan";
    protected $guarded = [];

    public function po()
    {
        return $this->belongsTo(TcErpPo::class, "po_id");
    }

    public function details()
    {
        return $this->hasMany(TcErpPenerimaanDetail::class, "penerimaan_id");
    }
}
