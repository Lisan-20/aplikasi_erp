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
        DB::statement("CREATE VIEW dbo.jurnal_dokter1_RI_v
AS
SELECT     dbo.bill_sed_ri_v.no_registrasi, dbo.bill_sed_ri_v.no_mr, dbo.bill_sed_ri_v.kode_kelompok, dbo.bill_sed_ri_v.kode_perusahaan, dbo.bill_sed_ri_v.jenis_tindakan, 
                      SUM(dbo.bill_sed_ri_v.bill_dr1) AS bill_dr1, dbo.bill_sed_ri_v.kode_dokter1, dbo.bill_sed_ri_v.kode_bagian, dbo.bill_sed_ri_v.flag_jurnal, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.mapping_transaksi_rs_v.nama_kredit, 
                      dbo.bill_sed_ri_v.kode_tc_trans_kasir, dbo.kasir_RI_v.seri_kuitansi, dbo.kasir_RI_v.no_kuitansi, dbo.kasir_RI_v.tgl_jam
FROM         dbo.bill_sed_ri_v INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.bill_sed_ri_v.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian INNER JOIN
                      dbo.kasir_RI_v ON dbo.bill_sed_ri_v.kode_tc_trans_kasir = dbo.kasir_RI_v.kode_tc_trans_kasir
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.bill_sed_ri_v.bill_dr1 > 0) AND (dbo.mapping_transaksi_rs_v.kode_jenis_proses = 11)
GROUP BY dbo.bill_sed_ri_v.no_registrasi, dbo.bill_sed_ri_v.no_mr, dbo.bill_sed_ri_v.kode_kelompok, dbo.bill_sed_ri_v.kode_perusahaan, dbo.bill_sed_ri_v.jenis_tindakan, 
                      dbo.bill_sed_ri_v.kode_dokter1, dbo.bill_sed_ri_v.kode_bagian, dbo.bill_sed_ri_v.flag_jurnal, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.mapping_transaksi_rs_v.nama_bagian, dbo.mapping_transaksi_rs_v.nama_kredit, dbo.bill_sed_ri_v.kode_tc_trans_kasir, dbo.kasir_RI_v.seri_kuitansi, 
                      dbo.kasir_RI_v.no_kuitansi, dbo.kasir_RI_v.tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_dokter1_RI_v]");
    }
};
