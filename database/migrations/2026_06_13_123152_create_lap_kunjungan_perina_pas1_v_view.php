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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_pas1_v
AS
SELECT        SUM(jml_pas) AS pas1, tgl, bln, thn, validasi_lap_rm
FROM            dbo.lap_kunjungan_perina_sum_all_v
WHERE        (kelas_pas = 5)
GROUP BY tgl, bln, thn, validasi_lap_rm
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_pas1_v]");
    }
};
