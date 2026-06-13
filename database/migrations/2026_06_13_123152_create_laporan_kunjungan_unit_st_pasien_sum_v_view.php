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
        DB::statement("CREATE VIEW dbo.laporan_kunjungan_unit_st_pasien_sum_v
AS
SELECT     kode_bagian, kode_perusahaan, COUNT(jml_pasien) AS jml_pasien, thn, bln, COUNT(stat_pasien) AS jml_lamabaru, stat_pasien
FROM         dbo.laporan_kunjungan_unit_st_pasien_v
GROUP BY kode_bagian, kode_perusahaan, thn, bln, stat_pasien
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [laporan_kunjungan_unit_st_pasien_sum_v]");
    }
};
