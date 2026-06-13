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
        DB::statement("CREATE OR ALTER VIEW dbo.th_icd10_pasien_top1_v
AS
SELECT     TOP (1) kode_icd_pasien, tgl_jam, kode_icd, kode_asterik, no_mr, group_depkes, no_registrasi, kode_bagian, kode_dokter, diagnosa, tipe_rl, status_itung, umur, gender, status_hidup, 
                      jns_penyakit, tgl_input, user_id, sys_lama, no_kunjungan, kode_riwayat
FROM         dbo.th_icd10_pasien
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [th_icd10_pasien_top1_v]");
    }
};
