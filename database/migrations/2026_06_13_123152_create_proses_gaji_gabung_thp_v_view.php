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
        DB::statement("CREATE VIEW dbo.proses_gaji_gabung_thp_v
AS
SELECT     npp, nama_pegawai, id_periode_gaji, status_periode_gaji, nominal_gaji_pokok, nominal_tunjangan, nominal_bonus, nominal_potongan, 
                      nominal_gaji_pokok + nominal_tunjangan + nominal_bonus - nominal_potongan AS nominal_thp, periode_gaji, kode_bagian, nama_bagian, periode_awal, periode_akhir, kode_dokter
FROM         dbo.proses_gaji_gabung_v
WHERE     (nominal_gaji_pokok > 0) AND (kode_dokter IS NULL) OR
                      (kode_dokter IN ('212', '127', '213', '314', '211', '432', '430', '476', '432', '481'))
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [proses_gaji_gabung_thp_v]");
    }
};
