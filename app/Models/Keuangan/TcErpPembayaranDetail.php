<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Akuntansi\TcErpTukarFaktur;

class TcErpPembayaranDetail extends Model
{
    use HasFactory;
    protected $table = "tc_erp_pembayaran_detail";
    protected $guarded = [];

    public function pembayaran()
    {
        return $this->belongsTo(TcErpPembayaran::class, "pembayaran_id");
    }

    public function tukarFaktur()
    {
        return $this->belongsTo(TcErpTukarFaktur::class, "tukar_faktur_id");
    }
}
