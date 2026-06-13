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
        DB::statement("CREATE VIEW dbo.lap_kunjungan_perina_aps2_v
AS
SELECT        SUM(jml_pas) AS aps2, validasi_lap_rm, tgl, bln, thn
FROM            dbo.lap_kunjungan_perina_sum_all_v
WHERE        (ket_keluar = 2) AND (kelas_pas = 6)
GROUP BY validasi_lap_rm, tgl, bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_aps2_v]");
    }
};
