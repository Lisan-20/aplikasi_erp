<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MtErpNegara extends Model
{
    protected $table = 'mt_erp_negara';

    protected $fillable = [
        'kode_negara',
        'nama_negara',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function provinsis(): HasMany
    {
        return $this->hasMany(MtErpProvinsi::class, 'negara_id');
    }
}
