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
        DB::statement("CREATE OR ALTER VIEW dbo.monitoring_pengiriman_rekanan_v
AS
SELECT     dbo.tc_pengiriman_brg_rekanan_detail.id_tc_pengiriman_rekanan, dbo.tc_pengiriman_brg_rekanan_detail.nomor_permintaan, dbo.mt_provider.nama_provider, 
                      COUNT(dbo.tc_pengiriman_brg_rekanan_detail.kode_brg) AS jml_brg, dbo.tc_pengiriman_rekanan.tgl_permintaan, SUM(dbo.tc_pengiriman_brg_rekanan_detail.jumlah) AS ttl_brg, 
                      dbo.tc_pengiriman_rekanan.kode_bagian_kirim
FROM         dbo.tc_pengiriman_brg_rekanan_detail INNER JOIN
                      dbo.mt_provider ON dbo.tc_pengiriman_brg_rekanan_detail.kode_perusahaan = dbo.mt_provider.kode_perusahaan INNER JOIN
                      dbo.tc_pengiriman_rekanan ON dbo.tc_pengiriman_brg_rekanan_detail.id_tc_pengiriman_rekanan = dbo.tc_pengiriman_rekanan.id_tc_pengiriman_rekanan
GROUP BY dbo.tc_pengiriman_brg_rekanan_detail.id_tc_pengiriman_rekanan, dbo.tc_pengiriman_brg_rekanan_detail.nomor_permintaan, dbo.mt_provider.nama_provider, 
                      dbo.tc_pengiriman_rekanan.tgl_permintaan, dbo.tc_pengiriman_rekanan.kode_bagian_kirim
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [monitoring_pengiriman_rekanan_v]");
    }
};
