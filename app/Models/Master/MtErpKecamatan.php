<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MtErpKecamatan extends Model
{
    protected $table = 'mt_erp_kecamatan';

    protected $fillable = [
        'kota_id',
        'kode_kecamatan',
        'nama_kecamatan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function kota(): BelongsTo
    {
        return $this->belongsTo(MtErpKota::class, 'kota_id');
    }

    public function kelurahans(): HasMany
    {
        return $this->hasMany(MtErpKelurahan::class, 'kecamatan_id');
    }
}
