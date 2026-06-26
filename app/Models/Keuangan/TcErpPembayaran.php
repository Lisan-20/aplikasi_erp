<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MtErpSupplier;
use App\Models\Master\MtErpCoa;

class TcErpPembayaran extends Model
{
    use HasFactory;
    protected $table = "tc_erp_pembayaran";
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(MtErpSupplier::class, "supplier_id");
    }

    public function akunKas()
    {
        return $this->belongsTo(MtErpCoa::class, "akun_kas_id");
    }

    public function details()
    {
        return $this->hasMany(TcErpPembayaranDetail::class, "pembayaran_id");
    }
}
