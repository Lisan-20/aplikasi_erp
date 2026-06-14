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
        DB::statement("CREATE OR ALTER VIEW dbo.v_sensus_gizi
AS
SELECT     dbo.tc_sensus_gizi.id_tc_sensus_gizi, dbo.tc_registrasi.no_mr, dbo.tc_registrasi.diagnosa, dbo.tc_sensus_gizi.diet, dbo.tc_sensus_gizi.perubahan_diet, 
                      dbo.tc_sensus_gizi.keterangan, dbo.tc_sensus_gizi.status_pasien, dbo.mt_master_pasien.nama_pasien, dbo.tc_registrasi.no_registrasi, 
                      dbo.tc_registrasi.tgl_jam_masuk, dbo.tc_sensus_gizi.tgl, dbo.tc_sensus_gizi.kode_penunjang, dbo.tc_sensus_gizi.alergi, dbo.tc_sensus_gizi.kode_icd_diagnosa, 
                      dbo.tc_sensus_gizi.diagnosa2, dbo.tc_sensus_gizi.kode_icd_diagnosa2
FROM         dbo.tc_sensus_gizi INNER JOIN
                      dbo.tc_registrasi ON dbo.tc_sensus_gizi.no_registrasi = dbo.tc_registrasi.no_registrasi INNER JOIN
                      dbo.mt_master_pasien ON dbo.tc_sensus_gizi.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_sensus_gizi]");
    }
};
