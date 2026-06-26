<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gudang\TcErpPenerimaan;

class TcErpTukarFakturDetail extends Model
{
    use HasFactory;
    protected $table = "tc_erp_tukar_faktur_detail";
    protected $guarded = [];

    public function tukarFaktur()
    {
        return $this->belongsTo(TcErpTukarFaktur::class, "tukar_faktur_id");
    }

    public function penerimaan()
    {
        return $this->belongsTo(TcErpPenerimaan::class, "penerimaan_id");
    }
}
