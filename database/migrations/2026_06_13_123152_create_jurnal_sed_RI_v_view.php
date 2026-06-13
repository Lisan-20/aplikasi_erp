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
        DB::statement("CREATE VIEW dbo.jurnal_sed_RI_v
AS
SELECT     dbo.kasir_RI_v.seri_kuitansi, dbo.kasir_RI_v.no_kuitansi, dbo.kasir_RI_v.tgl_jam, dbo.kasir_RI_v.kasir, dbo.mapping_transaksi_rs_v.kode_proses, 
                      dbo.mapping_transaksi_rs_v.acc_kredit, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.mapping_transaksi_rs_v.nama_kredit, dbo.bill_sed_ri_v.bill_rs, 
                      dbo.bill_sed_ri_v.bill_dr1, dbo.bill_sed_ri_v.no_registrasi, dbo.bill_sed_ri_v.no_mr, dbo.bill_sed_ri_v.kode_kelompok, dbo.bill_sed_ri_v.kode_perusahaan, 
                      dbo.bill_sed_ri_v.kode_bagian, dbo.bill_sed_ri_v.kode_dokter1, dbo.bill_sed_ri_v.kode_tc_trans_kasir, dbo.bill_sed_ri_v.lain_lain, dbo.bill_sed_ri_v.flag_jurnal, 
                      dbo.kasir_RI_v.kode_bagian AS kode_bagian_asal, dbo.bill_sed_ri_v.kode_barang, dbo.bill_sed_ri_v.jenis_tindakan
FROM         dbo.bill_sed_ri_v INNER JOIN
                      dbo.kasir_RI_v ON dbo.bill_sed_ri_v.kode_tc_trans_kasir = dbo.kasir_RI_v.kode_tc_trans_kasir INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.bill_sed_ri_v.jenis_tindakan = dbo.mapping_transaksi_rs_v.kode AND 
                      dbo.bill_sed_ri_v.kode_bagian_asal = dbo.mapping_transaksi_rs_v.kode_bagian AND 
                      dbo.bill_sed_ri_v.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian_asal
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2) AND (dbo.bill_sed_ri_v.jenis_tindakan <> 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_sed_RI_v]");
    }
};
