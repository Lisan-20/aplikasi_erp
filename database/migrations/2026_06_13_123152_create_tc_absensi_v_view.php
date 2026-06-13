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
        DB::statement("CREATE VIEW dbo.tc_absensi_v
AS
SELECT     id_tc_absensi, npp AS npp_r, id_dd_absensi, id_dd_jam_absen, tgl_absensi, jam_masuk, jam_pulang, id_dc_struktur_organisasi, input_id, input_tgl, status, status_tgl, ko_wil, keterangan, flag_um, 
                      flag_lem, id_check, CONVERT(int, REPLACE(npp, '%[^0-9a-zA-Z]%', '')) AS npp
FROM         dbo.tc_absensi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_absensi_v]");
    }
};
