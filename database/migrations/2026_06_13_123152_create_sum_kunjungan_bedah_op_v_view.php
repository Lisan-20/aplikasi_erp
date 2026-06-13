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
        DB::statement("CREATE VIEW dbo.sum_kunjungan_bedah_op_v
AS
SELECT     TOP (100) PERCENT COUNT(no_mr) AS jml_pasien, kode_tarif, kode_klas, kode_kelompok, kode_perusahaan, kode_bagian, MONTH(tgl_jam_masuk) AS bln, 
                      YEAR(tgl_jam_masuk) AS thn
FROM         dbo.lap_rl3_bedah_v
GROUP BY kode_perusahaan, kode_bagian, kode_tarif, kode_kelompok, kode_klas, MONTH(tgl_jam_masuk), YEAR(tgl_jam_masuk)
ORDER BY kode_kelompok
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [sum_kunjungan_bedah_op_v]");
    }
};
