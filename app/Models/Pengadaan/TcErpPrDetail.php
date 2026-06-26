<?php

namespace App\Models\Pengadaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcErpPrDetail extends Model
{
    use HasFactory;
    protected $table = "tc_erp_pr_detail";
    protected $guarded = [];

    public function pr()
    {
        return $this->belongsTo(TcErpPr::class, "pr_id");
    }
}
