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
        DB::statement("CREATE VIEW dbo.update_th_icd10_pasien_lama_v
AS
SELECT     dbo.th_riwayat_pasien_sytem_lama.TANGGAL AS tgl_jam, dbo.th_riwayat_pasien_sytem_lama.ICD AS kode_icd, 
                      dbo.th_riwayat_pasien_sytem_lama.T_MR AS no_mr, dbo.mt_master_icd10.no_urut_dtd AS group_depkes, 
                      dbo.th_riwayat_pasien_sytem_lama.KODE_BAGIAN_OK AS kode_bagian, 'A' AS tipe_rl, '1' AS status_hidup, 
                      dbo.th_riwayat_pasien_sytem_lama.T_UMURTHN AS umur, '1' AS status_itung, dbo.mt_master_icd10.nama_icd AS diagnosa, '1' AS sys_lama
FROM         dbo.th_riwayat_pasien_sytem_lama INNER JOIN
                      dbo.mt_master_icd10 ON dbo.th_riwayat_pasien_sytem_lama.ICD = dbo.mt_master_icd10.icd_10
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [update_th_icd10_pasien_lama_v]");
    }
};
