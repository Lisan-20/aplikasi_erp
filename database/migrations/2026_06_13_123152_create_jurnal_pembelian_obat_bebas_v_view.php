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
        DB::statement("CREATE VIEW dbo.jurnal_pembelian_obat_bebas_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, 
                      dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_pelayanan.tgl_transaksi, 
                      dbo.tc_trans_pelayanan.jenis_tindakan, dbo.tc_trans_pelayanan.nama_tindakan, dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.lain_lain, dbo.tc_trans_pelayanan.kode_trans_far, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.kode_bagian_asal, dbo.tc_trans_pelayanan.flag_jurnal, dbo.tc_trans_pelayanan.tgl_ver, dbo.tc_trans_kasir.seri_kuitansi, 
                      dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, dbo.fr_tc_far.no_resep, dbo.tran_sed.tx_nominal, dbo.tran_sed.kode, dbo.tran_sed.flag_jurnal AS flag_jurnal2
FROM         dbo.tc_trans_kasir INNER JOIN
                      dbo.tc_trans_pelayanan ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tc_trans_pelayanan.kode_tc_trans_kasir INNER JOIN
                      dbo.fr_tc_far ON dbo.tc_trans_pelayanan.kode_trans_far = dbo.fr_tc_far.kode_trans_far INNER JOIN
                      dbo.tran_sed ON dbo.tc_trans_kasir.kode_tc_trans_kasir = dbo.tran_sed.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_kasir.no_registrasi = 0) AND (dbo.tran_sed.flag_jurnal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_pembelian_obat_bebas_v]");
    }
};
