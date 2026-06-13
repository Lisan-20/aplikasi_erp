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
        DB::statement("CREATE VIEW dbo.updt_user_permohonan_po
AS
SELECT        dbo.tc_po.diajukan_oleh, dbo.tc_po_det.id_tc_permohonan, dbo.tc_permohonan.user_id, dbo.mt_karyawan.nama_pegawai
FROM            dbo.tc_po INNER JOIN
                         dbo.tc_po_det ON dbo.tc_po.id_tc_po = dbo.tc_po_det.id_tc_po INNER JOIN
                         dbo.tc_permohonan ON dbo.tc_po_det.id_tc_permohonan = dbo.tc_permohonan.id_tc_permohonan INNER JOIN
                         dbo.dd_user ON dbo.tc_permohonan.user_id = dbo.dd_user.id_dd_user INNER JOIN
                         dbo.mt_karyawan ON dbo.dd_user.no_induk = dbo.mt_karyawan.no_induk
");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS [updt_user_permohonan_po]");
    }
};
