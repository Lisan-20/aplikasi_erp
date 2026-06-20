<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcModular extends Model
{
    use HasFactory;

    protected $table = 'dc_modular';
    protected $primaryKey = 'id_dc_modular';
    public $timestamps = false;

    protected $fillable = [
        'nama_modular',
        'no_urut_modular',
        'kd_modular',
    ];

    public function moduls()
    {
        return $this->hasMany(DcModul::class, 'id_dc_modular', 'id_dc_modular');
    }
}
