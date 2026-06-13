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
        DB::statement("CREATE VIEW dbo.View_4
AS
SELECT     kode_dr, no_registrasi, tgl_transaksi, nama_tindakan, kode_bagian, flag_sppu, kode_kelompok, jumlah, { fn HOUR(tgl_transaksi) } AS jam
FROM         dbo.fee_dokter_rajal_temp
WHERE     (kode_dr = 221) AND ({ fn HOUR(tgl_transaksi) } > 17) AND (flag_sppu IS NULL)
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [View_4]");
    }
};
