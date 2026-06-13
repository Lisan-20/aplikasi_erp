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
        DB::statement("CREATE OR ALTER VIEW dbo.ver_pembayaran_tagihan_v
AS
SELECT     dbo.tc_bayar_tagih.id_tc_tagih, dbo.tc_bayar_tagih.no_kuitansi_bayar, dbo.tc_bayar_tagih.tgl_bayar, dbo.tc_bayar_tagih.jumlah_bayar, 
                      dbo.tc_tagih.no_invoice_tagih, dbo.tc_tagih.jenis_tagih, dbo.tc_tagih.nama_tertagih, dbo.tc_tagih.id_tertagih, dbo.tc_bayar_tagih.tgl_ver, 
                      dbo.tc_bayar_tagih.status_ver, dbo.tc_tagih.jumlah_tagih, (CASE WHEN dbo.tc_tagih.diskon IS NULL THEN 0 ELSE dbo.tc_tagih.diskon END) AS diskon, 
                      dbo.tc_bayar_tagih.id_tc_bayar_tagih
FROM         dbo.tc_bayar_tagih INNER JOIN
                      dbo.tc_tagih ON dbo.tc_bayar_tagih.id_tc_tagih = dbo.tc_tagih.id_tc_tagih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [ver_pembayaran_tagihan_v]");
    }
};
