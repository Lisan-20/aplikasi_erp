<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MtErpProvinsi extends Model
{
    protected $table = 'mt_erp_provinsi';

    protected $fillable = [
        'negara_id',
        'kode_provinsi',
        'nama_provinsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function negara(): BelongsTo
    {
        return $this->belongsTo(MtErpNegara::class, 'negara_id');
    }

    public function kotas(): HasMany
    {
        return $this->hasMany(MtErpKota::class, 'provinsi_id');
    }
}
