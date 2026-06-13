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
        DB::statement("CREATE VIEW dbo.adminTarifTindakanPershRI_v
AS
SELECT     kode_tarif, nama_tarif, kode_klas, nama_klas, bill_rs, bill_dr1, bill_dr2, kode_bagian, jenis_tindakan, kode_master_tarif_detail, kode_tgl_tarif, kode_tindakan, 
                      kode_perusahaan, bhp, pendapatan_rs, paramedis, pa_rs, pa_dr1, pa_dr2, bill_rs_spesialis, bill_dr1_spesialis, bill_dr2_spesialis, pendapatan_rs_spesialis, 
                      bill_rs_rujukan, total_spesialis
FROM         dbo.mt_tarif_perusahaan_v
WHERE     (kode_bagian LIKE '03%') AND (kode_bagian <> '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [adminTarifTindakanPershRI_v]");
    }
};
