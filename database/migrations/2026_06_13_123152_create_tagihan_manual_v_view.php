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
        DB::statement("CREATE VIEW dbo.tagihan_manual_v
AS
SELECT     TOP (100) PERCENT a.no_bukti, a.jumlah_transaksi AS jumlah_tagih, a.diskon, a.tgl_transaksi AS tgl_tagih, a.kode_perusahaan, b.nama_perusahaan, 
                      a.id_tc_tagih, dbo.dd_konfigurasi.nama_perusahaan AS untuk_tagihan
FROM         dbo.transaksi_piutang AS a INNER JOIN
                      dbo.mt_perusahaan AS b ON a.kode_perusahaan = b.kode_perusahaan INNER JOIN
                      dbo.dd_konfigurasi ON a.id_dd_konfigurasi = dbo.dd_konfigurasi.id_dd_konfigurasi
ORDER BY a.no_bukti DESC
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_manual_v]");
    }
};
