<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcModul extends Model
{
    use HasFactory;

    protected $table = 'dc_modul';

    protected $primaryKey = 'id_dc_modul';

    public $timestamps = false;

    protected $fillable = [
        'nama_modul',
        'logo',
        'id_dc_modular',
        'no_urut',
        'status_modul',
        'input_id',
        'input_tgl',
        'kode_bagian',
        'folder',
    ];

    public function modular()
    {
        return $this->belongsTo(DcModular::class, 'id_dc_modular', 'id_dc_modular');
    }

    public function menus()
    {
        return $this->hasMany(DcMenu::class, 'id_dc_modul', 'id_dc_modul');
    }
}
