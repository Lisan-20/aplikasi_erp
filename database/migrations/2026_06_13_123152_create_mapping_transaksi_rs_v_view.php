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
        DB::statement("CREATE OR ALTER VIEW dbo.mapping_transaksi_rs_v
AS
SELECT     dbo.mapping_proses.nama_proses, dbo.mapping_jenis_proses.kode_proses, dbo.mapping_jenis_proses.nama_jenis_proses, 
                      dbo.mapping_jenis_proses.kode_jenis_proses, dbo.mapping_transaksi.kode_mapping_transaksi, dbo.mapping_transaksi.acc_debet, 
                      dbo.mapping_transaksi.acc_kredit, dbo.mt_bagian.nama_bagian, dbo.mt_account.acc_nama AS nama_debet, mt_account_1.acc_nama AS nama_kredit, 
                      dbo.mapping_transaksi.kode_bagian, dbo.mapping_transaksi.kode_bagian_asal, dbo.mapping_jenis_proses.kode
FROM         dbo.mapping_proses INNER JOIN
                      dbo.mapping_jenis_proses ON dbo.mapping_proses.kode_proses = dbo.mapping_jenis_proses.kode_proses INNER JOIN
                      dbo.mapping_transaksi ON dbo.mapping_jenis_proses.kode_jenis_proses = dbo.mapping_transaksi.kode_jenis_proses AND 
                      dbo.mapping_proses.kode_proses = dbo.mapping_transaksi.kode_proses INNER JOIN
                      dbo.mt_bagian ON dbo.mapping_transaksi.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.mapping_transaksi.acc_kredit = mt_account_1.acc_no LEFT OUTER JOIN
                      dbo.mt_account ON dbo.mapping_transaksi.acc_debet = dbo.mt_account.acc_no
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mapping_transaksi_rs_v]");
    }
};
