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
        DB::statement("CREATE OR ALTER VIEW dbo.batal_tc_pemeriksaan_erm_v
AS
SELECT     dbo.tc_pemeriksaan_erm.kode_tc_periksa, dbo.tc_pemeriksaan_erm.id_mt_kd, dbo.tc_pemeriksaan_erm.kode_bagian, dbo.tc_pemeriksaan_erm.no_kunjungan, 
                      dbo.tc_pemeriksaan_erm.kode_pemeriksaan, dbo.tc_pemeriksaan_erm.nama_pemeriksaan, dbo.tc_pemeriksaan_erm.kd_lev, dbo.tc_pemeriksaan_erm.kd_type, dbo.tc_pemeriksaan_erm.ket, 
                      dbo.tc_pemeriksaan_erm.hasil, dbo.tc_pemeriksaan_erm.hasil2, dbo.tc_pemeriksaan_erm.no_urut_entry, dbo.tc_pemeriksaan_erm.kd_kk, dbo.tc_pemeriksaan_erm.no_registrasi, 
                      dbo.tc_pemeriksaan_erm.id_info, dbo.tc_pemeriksaan_erm.ket_hasil_bmi, dbo.tc_pemeriksaan_erm.no_mr, dbo.tc_pemeriksaan_erm.id_triase, dbo.tc_pemeriksaan_erm.sekor, 
                      dbo.tc_pemeriksaan_erm.kode_rm, dbo.tc_pemeriksaan_erm.no_urut, dbo.tc_pemeriksaan_erm.tgl_update, dbo.tc_pemeriksaan_erm.kode_rm_inp, 
                      dbo.tc_pemeriksaan_erm_batal.kode_tc_periksa AS Expr1
FROM         dbo.tc_pemeriksaan_erm LEFT OUTER JOIN
                      dbo.tc_pemeriksaan_erm_batal ON dbo.tc_pemeriksaan_erm.kode_tc_periksa = dbo.tc_pemeriksaan_erm_batal.kode_tc_periksa
WHERE     (dbo.tc_pemeriksaan_erm.no_registrasi IN
                          (SELECT     no_registrasi
                            FROM          dbo.tc_registrasi_batal)) AND (dbo.tc_pemeriksaan_erm_batal.kode_tc_periksa IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [batal_tc_pemeriksaan_erm_v]");
    }
};
