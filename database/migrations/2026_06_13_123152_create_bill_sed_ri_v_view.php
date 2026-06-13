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
        DB::statement("CREATE VIEW dbo.bill_sed_ri_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, SUM(dbo.tc_trans_pelayanan.bill_rs) AS bill_rs, 
                      SUM(dbo.tc_trans_pelayanan.bill_dr1) AS bill_dr1, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.seri_kuitansi, 
                      SUM(dbo.tc_trans_pelayanan.lain_lain) AS lain_lain, dbo.tc_trans_pelayanan.kode_barang
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.seri_kuitansi = 'RI')
GROUP BY dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kode_bagian, 
                      dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.status_selesai, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_pelayanan.kode_barang
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [bill_sed_ri_v]");
    }
};
