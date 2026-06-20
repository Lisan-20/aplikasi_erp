<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcSubMenu extends Model
{
    use HasFactory;

    protected $table = 'dc_sub_menu';
    protected $primaryKey = 'id_dc_sub_menu';
    public $timestamps = false;

    protected $fillable = [
        'id_dc_menu',
        'nama_sub_menu',
        'url_sub_menu',
        'url_sub_menu_baru',
        'keterangan',
        'no_urut',
        'status_sub_menu',
        'input_id',
        'input_tgl',
        'summary',
    ];

    public function menu()
    {
        return $this->belongsTo(DcMenu::class, 'id_dc_menu', 'id_dc_menu');
    }
}
