<?php

namespace App\Models\Gudang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengadaan\TcErpPoDetail;

class TcErpPenerimaanDetail extends Model
{
    use HasFactory;
    protected $table = "tc_erp_penerimaan_detail";
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->belongsTo(TcErpPenerimaan::class, "penerimaan_id");
    }

    public function poDetail()
    {
        return $this->belongsTo(TcErpPoDetail::class, "po_detail_id");
    }
}
