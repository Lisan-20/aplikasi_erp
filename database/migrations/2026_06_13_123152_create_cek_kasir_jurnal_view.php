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
        DB::statement("CREATE VIEW dbo.cek_kasir_jurnal
AS
SELECT     no_registrasi, seri_kuitansi, tgl_jam
FROM         dbo.tran_kasir
WHERE     (seri_kuitansi IN ('AI', 'RI'))
GROUP BY no_registrasi, seri_kuitansi, tgl_jam
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [cek_kasir_jurnal]");
    }
};
