<?php

namespace App\Models\Akuntansi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MtErpSupplier;

class TcErpTukarFaktur extends Model
{
    use HasFactory;
    protected $table = "tc_erp_tukar_faktur";
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(MtErpSupplier::class, "supplier_id");
    }

    public function details()
    {
        return $this->hasMany(TcErpTukarFakturDetail::class, "tukar_faktur_id");
    }
}
