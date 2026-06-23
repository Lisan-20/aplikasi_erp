<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MtErpKota extends Model
{
    protected $table = 'mt_erp_kota';

    protected $fillable = [
        'provinsi_id',
        'kode_kota',
        'nama_kota',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function provinsi(): BelongsTo
    {
        return $this->belongsTo(MtErpProvinsi::class, 'provinsi_id');
    }

    public function kecamatans(): HasMany
    {
        return $this->hasMany(MtErpKecamatan::class, 'kota_id');
    }
}
