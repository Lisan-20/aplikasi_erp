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
        DB::statement("CREATE OR ALTER VIEW dbo.master_pasien_baru_v
AS
SELECT     TOP (100) PERCENT NoMR AS no_mr, NamaPasien AS nama_pasien, NamaKeluarga AS nama_kel_pasien, TempatLahir AS tempat_lahir, CAST(TglLahir AS char) 
                      AS tgl_lhr, Umur AS umur_pasien, JenisKelamin AS jen_kelamin, Alamat AS almt_ttp_pasien, Tlp AS tlp_almt_ttp, Instansi AS perusahaan
FROM         dbo.Biodata
ORDER BY perusahaan
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [master_pasien_baru_v]");
    }
};
