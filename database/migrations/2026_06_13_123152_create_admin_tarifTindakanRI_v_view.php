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
        DB::statement("CREATE VIEW dbo.admin_tarifTindakanRI_v
AS
SELECT     kode_tarif, nama_tarif, kode_klas, nama_klas, bill_rs, bill_dr1, bill_dr2, kode_bagian, jenis_tindakan, kode_master_tarif_detail, kode_tgl_tarif, kode_tindakan, bhp, bill_rs_bpjs, bill_dr1_bpjs, 
                      bill_dr2_bpjs, bill_rs_bpjs_tk, bill_dr1_bpjs_tk, bill_dr2_bpjs_tk
FROM         dbo.mt_tarif_v
WHERE     (kode_bagian LIKE '03%') AND (kode_bagian <> '030901')
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [admin_tarifTindakanRI_v]");
    }
};
