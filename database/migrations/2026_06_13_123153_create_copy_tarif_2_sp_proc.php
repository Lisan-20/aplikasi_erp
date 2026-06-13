<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("create proc copy_tarif_2_sp
as
insert into mt_master_tarif (
kode_tarif,
kode_tindakan,
nama_tarif,
tingkatan,
ket,
kode_bagian,
referensi,
jenis_tindakan
)
select
kode_tarif,
kode_tindakan,
nama_tarif,
tingkatan,
ket,
kode_bagian,
referensi,
jenis_tindakan
from mt_master_tarif_b where kode_bagian='030901' and kode_tarif not in (select kode_tarif from mt_master_tarif);");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS copy_tarif_2_sp");
    }
};
