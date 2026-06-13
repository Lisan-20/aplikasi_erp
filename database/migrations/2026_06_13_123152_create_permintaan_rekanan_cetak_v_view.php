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
        DB::statement("CREATE VIEW dbo.permintaan_rekanan_cetak_v
AS
SELECT     dbo.mt_barang.nama_brg, dbo.mt_barang.satuan_kecil, dbo.tc_permintaan_rekanan_det.jumlah_permintaan, dbo.tc_permintaan_rekanan_det.kode_brg, 
                      dbo.tc_permintaan_rekanan_det.id_tc_permintaan_rekanan, dbo.tc_permintaan_rekanan_det.id_dd_user
FROM         dbo.tc_permintaan_rekanan_det INNER JOIN
                      dbo.mt_barang ON dbo.tc_permintaan_rekanan_det.kode_brg = dbo.mt_barang.kode_brg
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [permintaan_rekanan_cetak_v]");
    }
};
