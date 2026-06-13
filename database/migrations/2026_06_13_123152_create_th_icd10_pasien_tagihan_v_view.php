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
        DB::statement("CREATE VIEW dbo.th_icd10_pasien_tagihan_v
AS
SELECT     dbo.th_icd10_pasien.*, dbo.th_riwayat_pasien.diagnosa_akhir
FROM         dbo.th_icd10_pasien INNER JOIN
                      dbo.th_riwayat_pasien ON dbo.th_icd10_pasien.no_registrasi = dbo.th_riwayat_pasien.no_registrasi
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_tagihan_v]");
    }
};
