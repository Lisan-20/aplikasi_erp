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
        DB::statement("CREATE OR ALTER VIEW dbo.batal_tc_pemeriksaan_ri_v
AS
SELECT     dbo.tc_pemeriksaan_ri.kode_tc_periksa, dbo.tc_pemeriksaan_ri.id_mt_kd, dbo.tc_pemeriksaan_ri.kode_bagian, dbo.tc_pemeriksaan_ri.no_kunjungan, dbo.tc_pemeriksaan_ri.kode_pemeriksaan, 
                      dbo.tc_pemeriksaan_ri.nama_pemeriksaan, dbo.tc_pemeriksaan_ri.kd_lev, dbo.tc_pemeriksaan_ri.kd_type, dbo.tc_pemeriksaan_ri.ket, dbo.tc_pemeriksaan_ri.hasil, dbo.tc_pemeriksaan_ri.hasil2, 
                      dbo.tc_pemeriksaan_ri.no_urut_entry, dbo.tc_pemeriksaan_ri.kd_kk, dbo.tc_pemeriksaan_ri.no_registrasi, dbo.tc_pemeriksaan_ri.id_info, dbo.tc_pemeriksaan_ri.ket_hasil_bmi, 
                      dbo.tc_pemeriksaan_ri.no_mr, dbo.tc_pemeriksaan_ri.id_triase, dbo.tc_pemeriksaan_ri.sekor, dbo.tc_pemeriksaan_ri.kode_rm, dbo.tc_pemeriksaan_ri.no_urut_ews, dbo.tc_pemeriksaan_ri.no_urut, 
                      dbo.tc_pemeriksaan_ri.tgl_update, dbo.tc_pemeriksaan_ri_batal.kode_tc_periksa AS Expr1
FROM         dbo.tc_pemeriksaan_ri LEFT OUTER JOIN
                      dbo.tc_pemeriksaan_ri_batal ON dbo.tc_pemeriksaan_ri.kode_tc_periksa = dbo.tc_pemeriksaan_ri_batal.kode_tc_periksa
WHERE     (dbo.tc_pemeriksaan_ri.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_registrasi_batal)) AND (dbo.tc_pemeriksaan_ri_batal.kode_tc_periksa IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_tc_pemeriksaan_ri_v]");
    }
};
