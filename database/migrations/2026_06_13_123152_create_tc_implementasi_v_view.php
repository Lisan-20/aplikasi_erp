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
        DB::statement("CREATE VIEW dbo.tc_implementasi_v
AS
SELECT     dbo.tc_implementasi_detail.kode_pemeriksaan, dbo.tc_implementasi.id_imp, dbo.tc_implementasi.tgl_imp, dbo.tc_implementasi.id_user, dbo.tc_implementasi.kode_rm, 
                      dbo.tc_implementasi.tgl_ttd, dbo.tc_implementasi.ttd, dbo.tc_implementasi.ttd_nama, dbo.tc_implementasi.no_registrasi, dbo.tc_implementasi.no_kunjungan, dbo.tc_implementasi.no_mr, 
                      dbo.tc_implementasi.evaluasi, dbo.mt_acc_erm_imp.nama_implementasi, dbo.tc_implementasi.kode_rm_inp
FROM         dbo.tc_implementasi INNER JOIN
                      dbo.tc_implementasi_detail ON dbo.tc_implementasi.id_imp = dbo.tc_implementasi_detail.id_imp INNER JOIN
                      dbo.mt_acc_erm_imp ON dbo.tc_implementasi_detail.kode_pemeriksaan = dbo.mt_acc_erm_imp.kd_periksa
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [tc_implementasi_v]");
    }
};
