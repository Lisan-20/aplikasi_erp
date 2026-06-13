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
        DB::statement("CREATE VIEW dbo.v_uraian_gaji_detail
AS
SELECT     dbo.dc_transaksi.id_kd_transaksi, dbo.dc_transaksi.nm_grup_trans, dbo.dc_transaksi_detail.id_kd_transaksi_det, dbo.dc_transaksi_detail.nama_transkasi
FROM         dbo.dc_transaksi INNER JOIN
                      dbo.dc_transaksi_detail ON dbo.dc_transaksi.id_kd_transaksi = dbo.dc_transaksi_detail.id_kd_transaksi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [v_uraian_gaji_detail]");
    }
};
