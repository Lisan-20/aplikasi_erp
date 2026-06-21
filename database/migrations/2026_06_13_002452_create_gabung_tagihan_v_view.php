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
        DB::statement("CREATE OR ALTER VIEW dbo.gabung_tagihan_v
AS
SELECT        no_bukti, jumlah_tagih, CASE WHEN diskon IS NULL THEN 0 ELSE diskon END AS diskon, tgl_tagih, kode_perusahaan, nama_perusahaan, id_tc_tagih, untuk_tagihan
FROM            dbo.tagihan_manual_v
UNION
SELECT        no_bukti, jumlah_tagih, CASE WHEN diskon IS NULL THEN 0 ELSE diskon END AS diskon, tgl_tagih, kode_perusahaan, nama_perusahaan, id_tc_tagih, untuk_tagihan
FROM            dbo.tagihan_sistem_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [gabung_tagihan_v]");
    }
};
