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
        DB::statement("CREATE VIEW dbo.ak_dd_mapping_transaksi_v
AS
SELECT     dbo.ak_dd_mapping_transaksi.kode_mapping_transaksi, dbo.ak_dd_mapping_transaksi.kode_bagian, dbo.ak_dd_mapping_transaksi.kode_proses, 
                      dbo.ak_dd_mapping_transaksi.kode_jenis_proses, dbo.ak_dd_mapping_transaksi.kode_komponen, dbo.ak_dd_mapping_transaksi.acc_debet, 
                      dbo.ak_dd_mapping_transaksi.acc_kredit, dbo.ak_dd_mapping_proses.nama_proses, dbo.ak_dd_mapping_komponen.nama_komponen, 
                      dbo.ak_dd_mapping_jenis_proses.nama_jenis_proses, dbo.mt_bagian.nama_bagian, dbo.mt_account.acc_nama AS acc_nama_debet, 
                      mt_account_1.acc_nama AS acc_nama_kredit
FROM         dbo.ak_dd_mapping_komponen RIGHT OUTER JOIN
                      dbo.ak_dd_mapping_transaksi INNER JOIN
                      dbo.mt_bagian ON dbo.ak_dd_mapping_transaksi.kode_bagian = dbo.mt_bagian.kode_bagian LEFT OUTER JOIN
                      dbo.mt_account ON dbo.ak_dd_mapping_transaksi.acc_debet = dbo.mt_account.acc_no LEFT OUTER JOIN
                      dbo.mt_account AS mt_account_1 ON dbo.ak_dd_mapping_transaksi.acc_kredit = mt_account_1.acc_no LEFT OUTER JOIN
                      dbo.ak_dd_mapping_proses ON dbo.ak_dd_mapping_transaksi.kode_proses = dbo.ak_dd_mapping_proses.id_ak_dd_mapping_proses LEFT OUTER JOIN
                      dbo.ak_dd_mapping_jenis_proses ON dbo.ak_dd_mapping_transaksi.kode_jenis_proses = dbo.ak_dd_mapping_jenis_proses.id_ak_dd_mapping_jenis_proses ON 
                      dbo.ak_dd_mapping_komponen.id_ak_dd_mapping_komponen = dbo.ak_dd_mapping_transaksi.kode_komponen
WHERE     (dbo.ak_dd_mapping_transaksi.kode_bagian = N'010401')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ak_dd_mapping_transaksi_v]");
    }
};
