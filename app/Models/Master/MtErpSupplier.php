<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtErpSupplier extends Model
{
    use HasFactory;

    protected $table = 'mt_erp_supplier';

    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'alamat',
        'kota',
        'provinsi',
        'provinsi_id',
        'kota_id',
        'kodepos',
        'telepon_1',
        'telepon_2',
        'kontak_person',
        'npwp',
        'izin_usaha',
        'nama_bank',
        'is_active',
    ];

    public function provinsiModel()
    {
        return $this->belongsTo(\App\Models\Master\MtErpProvinsi::class, 'provinsi_id');
    }

    public function kotaModel()
    {
        return $this->belongsTo(\App\Models\Master\MtErpKota::class, 'kota_id');
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
