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
        DB::statement("CREATE VIEW dbo.lap_rekap_resep_new_v
AS
SELECT     dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.no_kunjungan, 
                      dbo.fr_tc_far.no_resep, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.petugas, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.no_registrasi, 
                      dbo.fr_tc_far_detail.status_retur
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.fr_tc_far_detail ON dbo.fr_tc_far.kode_trans_far = dbo.fr_tc_far_detail.kode_trans_far
GROUP BY dbo.fr_tc_far.kode_trans_far, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.dokter_pengirim, dbo.fr_tc_far.nama_pasien, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.kode_profit, dbo.fr_tc_far.no_kunjungan, 
                      dbo.fr_tc_far.no_resep, dbo.fr_tc_far.kode_pesan_resep, dbo.fr_tc_far.no_mr, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.petugas, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.no_registrasi, 
                      dbo.fr_tc_far_detail.status_retur
HAVING      (dbo.fr_tc_far.status_transaksi = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_rekap_resep_new_v]");
    }
};
