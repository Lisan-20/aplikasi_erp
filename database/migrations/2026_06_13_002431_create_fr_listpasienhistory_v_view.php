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
        DB::statement("CREATE OR ALTER VIEW dbo.fr_listpasienhistory_v
AS
SELECT     TOP 100 PERCENT dbo.fr_tc_far.no_mr, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.status_transaksi, 
                      dbo.mt_master_pasien.nama_pasien, dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.kode_profit, 
                      dbo.mt_bagian.nama_bagian, dbo.mt_master_pasien.kode_kelompok, dbo.mt_nasabah.nama_kelompok
FROM         dbo.fr_tc_far INNER JOIN
                      dbo.mt_master_pasien ON dbo.fr_tc_far.no_mr = dbo.mt_master_pasien.no_mr INNER JOIN
                      dbo.mt_bagian ON dbo.fr_tc_far.kode_bagian_asal = dbo.mt_bagian.kode_bagian INNER JOIN
                      dbo.mt_nasabah ON dbo.mt_master_pasien.kode_kelompok = dbo.mt_nasabah.kode_kelompok
GROUP BY dbo.fr_tc_far.no_mr, dbo.fr_tc_far.no_registrasi, dbo.fr_tc_far.kode_dokter, dbo.fr_tc_far.status_transaksi, dbo.mt_master_pasien.nama_pasien, 
                      dbo.fr_tc_far.kode_bagian, dbo.fr_tc_far.kode_bagian_asal, dbo.fr_tc_far.kode_profit, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_pasien.kode_kelompok, dbo.mt_nasabah.nama_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [fr_listpasienhistory_v]");
    }
};
