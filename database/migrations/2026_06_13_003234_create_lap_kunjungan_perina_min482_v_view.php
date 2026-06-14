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
        DB::statement("CREATE OR ALTER VIEW dbo.lap_kunjungan_perina_min482_v
AS
SELECT        SUM(jml_pas) AS min482, validasi_lap_rm, tgl, bln, thn
FROM            dbo.lap_kunjungan_perina_sum_all_v
WHERE        (kelas_pas = '6') AND (kode_kematian = '< 48 jam')
GROUP BY validasi_lap_rm, tgl, bln, thn
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [lap_kunjungan_perina_min482_v]");
    }
};
