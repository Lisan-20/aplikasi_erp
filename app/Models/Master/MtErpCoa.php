<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtErpCoa extends Model
{
    use HasFactory;
    protected $table = "mt_erp_coa";
    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(MtErpCoa::class, "parent_id");
    }

    public function children()
    {
        return $this->hasMany(MtErpCoa::class, "parent_id");
    }
}
