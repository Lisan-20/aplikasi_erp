<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtKaryawan extends Model
{
    use HasFactory;

    protected $table = 'mt_karyawan';
    protected $primaryKey = 'no_induk';
    public $timestamps = false;
    protected $guarded = [];

    public function bagian()
    {
        return $this->belongsTo(MtBagian::class, 'kode_bagian', 'kode_bagian');
    }
}
