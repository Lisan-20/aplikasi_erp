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
        DB::statement("CREATE VIEW dbo.th_riwayat_medis_pasien_gabung_v
AS
SELECT     *
FROM         th_riwayat_medis_pasien_1_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_2_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_3_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_4_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_5_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_6_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_7_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_8_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_9_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_10_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_11_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_13_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_14_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_15_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_16_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_17_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_18_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_19_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_20_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_21_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_22_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_23_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_24_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_25_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_28_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_30_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_31_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_32_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_33_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_34_v
UNION
SELECT     *
FROM         th_riwayat_medis_pasien_35_v
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_riwayat_medis_pasien_gabung_v]");
    }
};
