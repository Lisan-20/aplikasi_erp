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
        DB::statement("CREATE OR ALTER VIEW dbo.tagihan_sistem_v
AS
SELECT     TOP (100) PERCENT a.no_invoice_tagih AS no_bukti, a.jumlah_tagih, a.diskon, a.tgl_tagih, a.id_tertagih AS kode_perusahaan, a.nama_tertagih AS nama_perusahaan, a.id_tc_tagih, 
                      'RS Amanda Mitra Keluarga' AS untuk_tagihan
FROM         dbo.tc_tagih AS a LEFT OUTER JOIN
                      dbo.tc_bayar_tagih AS b ON b.id_tc_tagih = a.id_tc_tagih
WHERE     (a.status_batal IS NULL)
GROUP BY a.no_invoice_tagih, a.jumlah_tagih, a.tgl_tagih, a.id_tertagih, a.diskon, a.status_batal, a.nama_tertagih, a.status_batal, a.id_tc_tagih
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tagihan_sistem_v]");
    }
};
