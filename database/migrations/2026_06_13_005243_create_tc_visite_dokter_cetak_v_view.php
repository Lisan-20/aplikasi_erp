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
        DB::statement("CREATE OR ALTER VIEW dbo.tc_visite_dokter_cetak_v
AS
SELECT     dbo.tc_visite_dokter.tgl_jam, dbo.tc_visite_dokter.kode_shift, dbo.tc_visite_dokter.no_induk_per, dbo.tc_visite_dokter.kode_dokter, dbo.tc_visite_dokter_detail.no_mr, 
                      dbo.tc_visite_dokter_detail.no_registrasi, dbo.tc_visite_dokter_detail.no_kunjungan, dbo.tc_visite_dokter_detail.diagnosa, dbo.tc_visite_dokter_detail.program, dbo.tc_visite_dokter_detail.keluhan, 
                      dbo.tc_visite_dokter.no_urut_visit, dbo.tc_visite_dokter_detail.kode_trans_pelayanan_1, dbo.tc_visite_dokter_detail.kode_trans_pelayanan_2, dbo.tc_visite_dokter_detail.ruangan, 
                      dbo.tc_visite_dokter_detail.kelas, dbo.tc_visite_dokter_detail.tgl_masuk
FROM         dbo.tc_visite_dokter_detail INNER JOIN
                      dbo.tc_visite_dokter ON dbo.tc_visite_dokter_detail.no_urut_visit = dbo.tc_visite_dokter.no_urut_visit
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_visite_dokter_cetak_v]");
    }
};
