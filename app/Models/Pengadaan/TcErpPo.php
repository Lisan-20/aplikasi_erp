<?php

namespace App\Models\Pengadaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\MtErpSupplier;

class TcErpPo extends Model
{
    use HasFactory;
    protected $table = "tc_erp_po";
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(MtErpSupplier::class, "supplier_id");
    }

    public function details()
    {
        return $this->hasMany(TcErpPoDetail::class, "po_id");
    }
}
