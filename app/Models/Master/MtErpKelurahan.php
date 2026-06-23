<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtErpKelurahan extends Model
{
    protected $table = 'mt_erp_kelurahan';

    protected $fillable = [
        'kecamatan_id',
        'kode_kelurahan',
        'nama_kelurahan',
        'kodepos',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(MtErpKecamatan::class, 'kecamatan_id');
    }
}
