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
        DB::statement("CREATE VIEW dbo.mapping_transaksi_v
AS
SELECT     dbo.ak_dd_mapping_transaksi.kode_mapping_transaksi, dbo.ak_dd_mapping_transaksi.kode_bagian, dbo.ak_dd_mapping_transaksi.kode_proses, 
                      dbo.ak_dd_mapping_transaksi.kode_jenis_proses, dbo.ak_dd_mapping_transaksi.kode_komponen, dbo.ak_dd_mapping_transaksi.acc_debet, 
                      dbo.ak_dd_mapping_transaksi.acc_kredit, dbo.ak_dd_mapping_jenis_proses.kode
FROM         dbo.ak_dd_mapping_proses INNER JOIN
                      dbo.ak_dd_mapping_jenis_proses ON 
                      dbo.ak_dd_mapping_proses.id_ak_dd_mapping_proses = dbo.ak_dd_mapping_jenis_proses.id_ak_dd_mapping_proses INNER JOIN
                      dbo.ak_dd_mapping_transaksi ON dbo.ak_dd_mapping_proses.id_ak_dd_mapping_proses = dbo.ak_dd_mapping_transaksi.kode_proses AND 
                      dbo.ak_dd_mapping_jenis_proses.id_ak_dd_mapping_jenis_proses = dbo.ak_dd_mapping_transaksi.kode_jenis_proses
WHERE     (dbo.ak_dd_mapping_jenis_proses.kode > 0)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [mapping_transaksi_v]");
    }
};
