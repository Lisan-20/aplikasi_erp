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
        DB::statement("CREATE VIEW dbo.pasien_perina_paket_v
AS
SELECT     no_mr, bulan, tahun, nama_tarif, 5 AS kode_klasifikasi, nama_pasien
FROM         dbo.pasien_perina_v
WHERE     (nama_tarif LIKE '%partus%') OR
                      (nama_tarif LIKE '%2dc%') OR
                      (nama_tarif LIKE '%3dc%') OR
                      (nama_tarif LIKE '%manual%')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_perina_paket_v]");
    }
};
