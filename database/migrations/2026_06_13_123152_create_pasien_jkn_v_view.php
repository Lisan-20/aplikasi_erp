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
        DB::statement("CREATE VIEW dbo.pasien_jkn_v
AS
SELECT     dbo.mt_master_pasien_jkn_tmp.id_pasien_jkn, dbo.mt_master_pasien_jkn_tmp.no_mr_int, dbo.mt_master_pasien_jkn_tmp.nomorkartu, dbo.mt_bagian.nama_bagian, 
                      dbo.mt_master_pasien_jkn_tmp.ktp, dbo.mt_master_pasien_jkn_tmp.notlp, dbo.mt_master_pasien_jkn_tmp.tgl_R_periksa, dbo.mt_master_pasien_jkn_tmp.nomorreferensi, 
                      dbo.mt_master_pasien_jkn_tmp.keluhan, dbo.mt_master_pasien_jkn_tmp.tgl_input, dbo.mt_master_pasien_jkn_tmp.alasan_batal, dbo.mt_master_pasien_jkn_tmp.user_batal, 
                      dbo.mt_master_pasien_jkn_tmp.tgl_validasi, dbo.mt_master_pasien_jkn_tmp.status_batal
FROM         dbo.mt_master_pasien_jkn_tmp INNER JOIN
                      dbo.mt_bagian ON dbo.mt_master_pasien_jkn_tmp.kodepoli = dbo.mt_bagian.kode_poli_vclaim
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [pasien_jkn_v]");
    }
};
