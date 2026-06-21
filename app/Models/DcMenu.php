<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcMenu extends Model
{
    use HasFactory;

    protected $table = 'dc_menu';

    protected $primaryKey = 'id_dc_menu';

    public $timestamps = false;

    protected $fillable = [
        'id_dc_modul',
        'nama_menu',
        'url',
        'no_urut',
        'status_menu',
        'input_id',
        'input_tgl',
        'flag_not',
    ];

    public function modul()
    {
        return $this->belongsTo(DcModul::class, 'id_dc_modul', 'id_dc_modul');
    }

    public function subMenus()
    {
        return $this->hasMany(DcSubMenu::class, 'id_dc_menu', 'id_dc_menu');
    }
}
