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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_pm_tindakan_sum_v
AS
SELECT     kode_tarif, nama_tindakan, SUM(jumlah) AS jml_tindakan, kode_bagian, tgl, bln, thn
FROM         dbo.lap_kunjungan_new_tindakan_v
GROUP BY kode_tarif, nama_tindakan, kode_bagian, tgl, bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_pm_tindakan_sum_v]");
    }
};
