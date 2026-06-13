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
        DB::statement("CREATE VIEW dbo.cek_absen_v
AS
SELECT     MAX(id_tc_absensi) AS id, npp, id_dd_absensi, id_dd_jam_absen, tgl_absensi, jam_masuk, jam_pulang, id_dc_struktur_organisasi, status, status_tgl, ko_wil, keterangan, COUNT(jam_masuk) 
                      AS Expr2
FROM         dbo.tc_absensi
GROUP BY npp, id_dd_absensi, id_dd_jam_absen, tgl_absensi, jam_masuk, jam_pulang, id_dc_struktur_organisasi, status, status_tgl, ko_wil, keterangan
HAVING      (COUNT(jam_masuk) > 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_absen_v]");
    }
};
