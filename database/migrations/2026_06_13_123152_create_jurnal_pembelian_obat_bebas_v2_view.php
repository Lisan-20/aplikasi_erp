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
        DB::statement("CREATE OR ALTER VIEW dbo.jurnal_pembelian_obat_bebas_v2
AS
SELECT     dbo.jurnal_pembelian_obat_bebas_v.kode_tc_trans_kasir, dbo.jurnal_pembelian_obat_bebas_v.kode_perusahaan, dbo.jurnal_pembelian_obat_bebas_v.tgl_transaksi, 
                      dbo.jurnal_pembelian_obat_bebas_v.jenis_tindakan, SUM(dbo.jurnal_pembelian_obat_bebas_v.bill_rs) AS bill_rs, dbo.jurnal_pembelian_obat_bebas_v.kode_trans_far, 
                      dbo.jurnal_pembelian_obat_bebas_v.kode_bagian, dbo.jurnal_pembelian_obat_bebas_v.kode_bagian_asal, dbo.jurnal_pembelian_obat_bebas_v.flag_jurnal, 
                      dbo.jurnal_pembelian_obat_bebas_v.tgl_ver, dbo.mapping_transaksi_rs_v.acc_kredit, dbo.jurnal_pembelian_obat_bebas_v.no_registrasi, 
                      dbo.jurnal_pembelian_obat_bebas_v.nama_pasien_layan, dbo.jurnal_pembelian_obat_bebas_v.kode_kelompok, dbo.mapping_transaksi_rs_v.kode_jenis_proses, 
                      dbo.jurnal_pembelian_obat_bebas_v.no_mr, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.jurnal_pembelian_obat_bebas_v.seri_kuitansi, dbo.jurnal_pembelian_obat_bebas_v.no_kuitansi, 
                      dbo.jurnal_pembelian_obat_bebas_v.tgl_jam, dbo.jurnal_pembelian_obat_bebas_v.no_resep, dbo.jurnal_pembelian_obat_bebas_v.kode, dbo.jurnal_pembelian_obat_bebas_v.tx_nominal
FROM         dbo.jurnal_pembelian_obat_bebas_v INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.jurnal_pembelian_obat_bebas_v.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian AND 
                      dbo.jurnal_pembelian_obat_bebas_v.kode = dbo.mapping_transaksi_rs_v.kode
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 2)
GROUP BY dbo.jurnal_pembelian_obat_bebas_v.kode_tc_trans_kasir, dbo.jurnal_pembelian_obat_bebas_v.kode_perusahaan, dbo.jurnal_pembelian_obat_bebas_v.tgl_transaksi, 
                      dbo.jurnal_pembelian_obat_bebas_v.jenis_tindakan, dbo.jurnal_pembelian_obat_bebas_v.kode_trans_far, dbo.jurnal_pembelian_obat_bebas_v.kode_bagian, 
                      dbo.jurnal_pembelian_obat_bebas_v.kode_bagian_asal, dbo.jurnal_pembelian_obat_bebas_v.flag_jurnal, dbo.jurnal_pembelian_obat_bebas_v.tgl_ver, dbo.mapping_transaksi_rs_v.acc_kredit, 
                      dbo.jurnal_pembelian_obat_bebas_v.no_registrasi, dbo.jurnal_pembelian_obat_bebas_v.nama_pasien_layan, dbo.jurnal_pembelian_obat_bebas_v.kode_kelompok, 
                      dbo.mapping_transaksi_rs_v.kode_jenis_proses, dbo.jurnal_pembelian_obat_bebas_v.no_mr, dbo.mapping_transaksi_rs_v.nama_bagian, dbo.jurnal_pembelian_obat_bebas_v.seri_kuitansi, 
                      dbo.jurnal_pembelian_obat_bebas_v.no_kuitansi, dbo.jurnal_pembelian_obat_bebas_v.tgl_jam, dbo.jurnal_pembelian_obat_bebas_v.no_resep, dbo.jurnal_pembelian_obat_bebas_v.kode, 
                      dbo.jurnal_pembelian_obat_bebas_v.tx_nominal
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pembelian_obat_bebas_v2]");
    }
};
