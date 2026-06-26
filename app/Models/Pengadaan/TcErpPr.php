<?php

namespace App\Models\Pengadaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TcErpPr extends Model
{
    use HasFactory;
    protected $table = "tc_erp_pr";
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(TcErpPrDetail::class, "pr_id");
    }
}
