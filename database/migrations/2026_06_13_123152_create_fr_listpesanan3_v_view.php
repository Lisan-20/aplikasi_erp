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
        DB::statement("CREATE VIEW dbo.fr_listpesanan3_v
AS
SELECT     dbo.mt_master_pasien.no_mr, dbo.mt_master_pasien.nama_pasien, dbo.mt_bagian.nama_bagian, dbo.fr_tc_far.kode_trans_far, 
                      dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.tgl_trans, dbo.fr_tc_far.status_transaksi, dbo.fr_tc_far.no_registrasi, 
                      dbo.fr_tc_far.no_kunjungan, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.kode_profit
FROM         dbo.mt_bagian RIGHT OUTER JOIN
                      dbo.fr_tc_far ON dbo.mt_bagian.kode_bagian = dbo.fr_tc_far.kode_bagian_asal LEFT OUTER JOIN
                      dbo.mt_master_pasien ON dbo.fr_tc_far.no_mr = dbo.mt_master_pasien.no_mr
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_listpesanan3_v]");
    }
};
