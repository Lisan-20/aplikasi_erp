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
        DB::statement("CREATE VIEW dbo.persen_resep_dr_v
AS
SELECT     dbo.tc_trans_pelayanan.kode_trans_pelayanan, dbo.tc_trans_pelayanan.kode_tc_trans_kasir, dbo.tc_trans_pelayanan.no_kunjungan, 
                      dbo.tc_trans_pelayanan.no_registrasi, dbo.tc_trans_pelayanan.no_mr, dbo.tc_trans_pelayanan.nama_pasien_layan, dbo.tc_trans_pelayanan.kode_kelompok, 
                      dbo.tc_trans_pelayanan.kode_perusahaan, dbo.tc_trans_kasir.seri_kuitansi, dbo.tc_trans_kasir.no_kuitansi, dbo.tc_trans_kasir.tgl_jam, 
                      dbo.tc_trans_pelayanan.bill_rs, dbo.tc_trans_pelayanan.kode_dokter1, dbo.tc_trans_pelayanan.kd_tr_resep, dbo.tc_trans_pelayanan.kode_trans_far, 
                      dbo.tc_trans_pelayanan.jumlah, dbo.tc_trans_pelayanan.kode_barang, dbo.tc_trans_pelayanan.flag_obat, dbo.tc_trans_pelayanan.nama_tindakan, 
                      dbo.tc_trans_pelayanan.kode_bagian, dbo.tc_trans_pelayanan.tgl_transaksi, dbo.tc_trans_pelayanan.kode_bagian_asal
FROM         dbo.tc_trans_pelayanan INNER JOIN
                      dbo.tc_trans_kasir ON dbo.tc_trans_pelayanan.kode_tc_trans_kasir = dbo.tc_trans_kasir.kode_tc_trans_kasir
WHERE     (dbo.tc_trans_pelayanan.jenis_tindakan = 11) AND (YEAR(dbo.tc_trans_kasir.tgl_jam) >= 2014) AND (dbo.tc_trans_pelayanan.status_kredit = 0) AND 
                      (dbo.tc_trans_pelayanan.status_batal IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [persen_resep_dr_v]");
    }
};
