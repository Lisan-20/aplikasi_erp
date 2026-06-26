<?php

namespace App\Models\Pengadaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcErpPoDetail extends Model
{
    use HasFactory;
    protected $table = "tc_erp_po_detail";
    protected $guarded = [];

    public function po()
    {
        return $this->belongsTo(TcErpPo::class, "po_id");
    }

    public function prDetail()
    {
        return $this->belongsTo(TcErpPrDetail::class, "pr_detail_id");
    }
}
