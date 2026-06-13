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
        DB::statement("CREATE VIEW dbo.jurnal_kasir_jual_obat_bebas_v
AS
SELECT     dbo.tran_kasir_bebas.*, dbo.mapping_transaksi_rs_v.nama_proses, dbo.mapping_transaksi_rs_v.kode_proses, dbo.mapping_transaksi_rs_v.kode_jenis_proses, 
                      dbo.mapping_transaksi_rs_v.acc_debet, dbo.mt_bagian.nama_bagian
FROM         dbo.tran_kasir_bebas INNER JOIN
                      dbo.mapping_transaksi_rs_v ON dbo.tran_kasir_bebas.kode = dbo.mapping_transaksi_rs_v.kode AND dbo.tran_kasir_bebas.kode_bagian = dbo.mapping_transaksi_rs_v.kode_bagian INNER JOIN
                      dbo.mt_bagian ON dbo.tran_kasir_bebas.kode_bagian = dbo.mt_bagian.kode_bagian
WHERE     (dbo.mapping_transaksi_rs_v.kode_proses = 1)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [jurnal_kasir_jual_obat_bebas_v]");
    }
};
